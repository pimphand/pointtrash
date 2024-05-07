<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderDatumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $status)
    {
        $segment = $request->segment(2);
        if ($request->ajax()) {
            $data = QueryBuilder::for(OrderData::with('user'))
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::partial('user.name', 'search'),
                    AllowedFilter::exact('status'),
                ])
                ->where('type', $status)
                ->orderBy('date_create', 'desc');

            if ($segment == 'history') {
                $data->where('status', '=', 1);
            } else {
                $data->where('status', '!=', 1);
            }

            $result = $data->paginate($request->per_page ?? 15);
            $shareProfitData = DB::table('share_profit_'.$status)->first();

            return response()->json([
                'data' => $result,
                'share_profit' => $shareProfitData,
            ]);
        }

        return view('admin.orders.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, $id)
    {
        $data = OrderData::with(['user', 'details.category', 'partner'])->where('order_id', $id)->first();
        $get_total_weight = DB::table('detail_order')
            ->select(DB::raw('SUM(quantity) as total_quantity'))
            ->where('order_id', $id)
            ->first();

        // Mengecek apakah jumlah memiliki desimal
        if ($get_total_weight) {
            $total_quantity = $get_total_weight->total_quantity;
            $decimal_position = strpos((string) $total_quantity, '.');

            if ($decimal_position !== false) {
                // Jika ada titik desimal, ambil dua angka pertama setelah titik
                $rounded_total_quantity = substr($total_quantity, 0, $decimal_position + 2);
                $data['total_weight'] = $rounded_total_quantity;
            } else {
                // Jika tidak ada titik desimal, langsung masukkan nilainya
                $data['total_weight'] = $total_quantity;
            }
        } else {
            $data['total_weight'] = 0; // Jika tidak ada hasil, atur menjadi 0
        }

        return view('admin.orders.show', compact('data', 'type'));
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
        //
    }

    /**
     * export the specified resource from storage.
     */
    public function export(Request $request, $type)
    {
        $data = QueryBuilder::for(OrderData::with('user'))
            ->allowedFilters([
                AllowedFilter::scope('search', 'search'),
                AllowedFilter::partial('user.name', 'search'),
                AllowedFilter::exact('status'),
            ])
            ->where('type', $type)
            ->where('status', '!=', 1)
            ->orderBy('date_create', 'desc')->get();

    }

    /**
     * update the specified resource from storage.
     */
    public function updateShareProfit(Request $request, string $type)
    {
        $validated = Validator::make($request->all(), [
            'for_user' => 'required|numeric',
            'for_company' => 'required|numeric',
            'for_partner' => function ($attribute, $value, $fail) use ($type) {
                if ($type !== 'drop_off' && ! is_numeric($value)) {
                    $fail("The $attribute field must be numeric.");
                }
            },
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $updateData = [
            'for_user' => $request->for_user,
            'for_company' => $request->for_company,
        ];

        if ($type !== 'drop_off') {
            $updateData['for_partner'] = $request->for_partner;
        }

        try {
            $updateResult = DB::table('share_profit_'.$type)->first();
            DB::table('share_profit_'.$type)->where('id', $updateResult->id)->update($updateData);

            return response()->json([
                'status' => 'success',
                'message' => 'Data has been updated successfully.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during the update: '.$e->getMessage(),
            ], 500); // Status 500: Internal Server Error
        }
    }

    /**
     * Show the history of the specified resource.
     */
    public function history(Request $request, $status)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(OrderData::with('user'))
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::partial('user.name', 'search'),
                    AllowedFilter::exact('status'),
                ])
                ->where('type', 'Pickup')
                ->where('status', '=', 1)
                ->orderBy('date_create', 'desc');

            $data->paginate($request->per_page ?? 15);
            $shareProfitData = DB::table('share_profit_'.$status)->first();

            return response()->json([
                'data' => $data,
                'share_profit' => $shareProfitData,
            ]);
        }

        return view('admin.orders.index', compact('status'));
    }
}
