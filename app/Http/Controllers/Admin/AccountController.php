<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\HistorySaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(Account::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::exact('roles'),
                ])
                ->orderBy('name', 'desc');
            $data->where('roles', 'cabang');

            $data = $data->paginate($request->per_page ?? 15);

            return response()->json([
                'data' => $data,
            ]);
        }

        return view('admin.account.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:account,email',
            'phone' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'roles' => 'required|in:admin,cabang',
            'saldo' => 'nullable|integer',
        ])->validate();

        $account = Account::create($validated);

        if ($request->saldo) {
            HistorySaldo::create([
                'account_id' => $account->account_id,
                'saldo' => $request->saldo,
                'saldo_before' => 0,
                'saldo_after' => $request->saldo,
                'type' => 'credit',
                'description' => 'Saldo Awal',
            ]);
        }

        return response()->json([
            'message' => 'Account created successfully',
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
        $user = Account::withCount(['users', 'partners'])->find($id);
        //        dd($user);

        return view('admin.account.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return response()->json([
            'message' => 'Account deleted successfully',
        ]);
    }

    public function addSaldo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'saldo' => 'required|integer',
            'type' => 'required|in:debit,credit',
            'description' => 'required|string',
        ])->validate();

        $account = Account::findOrFail($id);
        //if type is debit

        $saldoBefore = $account->saldo;
        if ($request->type == 'debit') {
            $saldoAfter = $saldoBefore + $request->saldo;
        } else {
            $saldoAfter = $saldoBefore - $request->saldo;
        }

        $account->update([
            'saldo' => $saldoAfter,
        ]);

        HistorySaldo::create([
            'account_id' => $account->account_id,
            'saldo' => $request->saldo,
            'saldo_before' => $saldoBefore,
            'saldo_after' => $saldoAfter,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Saldo added successfully',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);
        Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:account,email,' . $id . ',account_id',
            'phone' => 'required|string',
            'address' => 'required|string',
            'branch' => 'required|string',
            //            'roles' => 'required|in:admin,cabang',
        ])->validate();

        $accountData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'branch' => $request->branch,
            // 'password' => $request->password ? bcrypt($request->password) : $account->password,
        ];

        $account->update($accountData);

        return response()->json([
            'message' => 'Account created successfully',
        ]);
    }

    public function data(Request $request, $id)
    {
        $account = Account::findOrFail($id);

        if ($request->type == 'history') {
            $type = $account->historySaldos()->orderBy('created_at', 'desc')->paginate($request->per_page ?? 15);
        }
        if ($request->type == 'mitra') {
            $type = $account->partners()->paginate($request->per_page ?? 15);
        }
        if ($request->type == 'user') {
            $type = $account->users()->paginate($request->per_page ?? 15);
        }

        return response()->json([
            'data' => $account,
            'data_table' => $type,
        ]);
    }
}
