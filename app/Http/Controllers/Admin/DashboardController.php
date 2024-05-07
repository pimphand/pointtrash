<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function data(): \Illuminate\Http\JsonResponse
    {
        $orders = DB::table('order_data')
            ->whereIn('type', ['pickup', 'Drop Off', 'Company', 'Event'])
            ->select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();
        $widraw_counts = DB::table('widraw_partner')
            ->whereIn('type', ['Gopay', 'OVO', 'Shopeepay'])
            ->select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->unionAll(
                DB::table('widraw_user')
                    ->whereIn('type', ['Gopay', 'OVO', 'Shopeepay'])
                    ->select('type', DB::raw('COUNT(*) as count'))
                    ->groupBy('type')
            )
            ->get();

        $totals = [];
        foreach ($widraw_counts as $count) {
            $type = strtolower(str_replace(' ', '', $count->type));
            $totals[$type] = isset($totals[$type]) ? $totals[$type] + $count->count : $count->count;
        }

        $partners = DB::table('partner')
            ->join('rating', 'rating.partner_id', '=', 'partner.partner_id')
            ->select('partner.partner_id', 'partner.photo', 'partner.name', 'partner.point', DB::raw('AVG(rating.rating) AS partner_rating'))
            ->groupBy('partner.partner_id', 'partner.name', 'partner.photo', 'partner.point')
            ->orderByDesc('partner_rating')
            ->limit(10)
            ->get();

        $data = [
            'users' => DB::table('user')->count(),
            'mitra' => DB::table('partner')->count(),
            'order' => $orders,
            'widraw' => $totals,
            'rating' => $partners,
        ];

        return response()->json($data);
    }
}
