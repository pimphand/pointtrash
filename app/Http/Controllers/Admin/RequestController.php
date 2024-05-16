<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\HistorySaldo;
use App\Models\RequestSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(RequestSaldo::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                ])
                ->with('account:account_id,name')
                ->orderBy('created_at', 'desc');
            if (Auth::guard('admin')->user()->roles == 'cabang') {
                $data->where('account_id', Auth::guard('admin')->user()->account_id);
            }
            $result = $data->paginate($request->per_page ?? 15);

            return response()->json([
                'data' => $result,
            ]);
        }

        return view('admin.request.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'saldo' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $saldo = Auth::guard('admin')->user()->saldo;
                    $saldo_request = $value;
                    $type = $request->type;

                    if ($type == 'widraw') {
                        if ($saldo < $saldo_request) {
                            $fail('Saldo tidak mencukupi.'); // Validation fails with this message
                        }
                    }
                },
            ],
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string',
        ])->validate();

        RequestSaldo::create([
            'account_id' => Auth::guard('admin')->user()->account_id,
            'saldo' => $request->saldo,
            'status' => '0',
            'type' => $request->type,
        ]);

        return response()->json([
            'message' => 'Request saldo berhasil dibuat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($request->file('file')) {
                $thumbnail = $request->file('file');
                $icon_name = 'bukti_'.time().'.'.$thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('upload'), $icon_name);
            }

            $user = Auth::guard('admin')->user();

            if ($user->roles == 'cabang') {
                RequestSaldo::find($id)->update([
                    'bukti' => $icon_name ?? null,
                ]);
            } else {
                $requestSaldo = RequestSaldo::find($id);
                $account = Account::whereAccountId($requestSaldo->account_id)->first();

                if ($requestSaldo->type == 'widraw') {
                    if ($request->type == 'approve') {
                        HistorySaldo::create([
                            'account_id' => $account->account_id,
                            'saldo' => $request->saldo,
                            'saldo_before' => $account->saldo,
                            'saldo_after' => $account->saldo - $request->saldo,
                            'type' => $request->type,
                            'description' => $request->description,
                        ]);

                        $account->update([
                            'saldo' => $account->saldo - $requestSaldo->saldo,
                        ]);
                    }
                } else {
                    if ($request->type == 'approve') {
                        HistorySaldo::create([
                            'account_id' => $account->account_id,
                            'saldo' => $request->saldo,
                            'saldo_before' => $account->saldo,
                            'saldo_after' => $account->saldo + $request->saldo,
                            'type' => $request->type,
                            'description' => $request->description,
                        ]);

                        $account->update([
                            'saldo' => $account->saldo + $requestSaldo->saldo,
                        ]);
                    }
                }

                $requestSaldo->update([
                    'status' => $request->type == 'approve' ? '1' : '2',
                ]);
            }

            return response()->json([
                'message' => 'Request saldo berhasil diupdate',
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
