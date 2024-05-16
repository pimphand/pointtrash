<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function data(): JsonResponse
    {
        $orders = DB::table('order_data')
            ->whereIn('type', ['pickup', 'Drop Off', 'Company', 'Event'])
            ->select('type', DB::raw('COUNT(*) as count'))
            ->join('user', 'order_data.user_id', '=', 'user.user_id')
            ->where(function ($query) {
                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $query->where('user.account_id', Auth::guard('admin')->user()->account_id);
                }
            })
            ->groupBy('type')
            ->get();
        $widraw_counts = DB::table('widraw_partner')
            ->whereIn('type', ['Gopay', 'OVO', 'Shopeepay'])
            ->where(function ($query) {
                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $query->where('partner.account_id', Auth::guard('admin')->user()->account_id);
                }
            })
            //join table widraw_partner and partner
            ->join('partner', 'widraw_partner.partner_id', '=', 'partner.partner_id')
            ->select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->unionAll(
                DB::table('widraw_user')
                    ->whereIn('type', ['Gopay', 'OVO', 'Shopeepay'])
                    ->join('user', 'widraw_user.user_id', '=', 'user.user_id')
                    ->where(function ($query) {
                        if (Auth::guard('admin')->user()->roles == 'cabang') {
                            $query->where('user.account_id', Auth::guard('admin')->user()->account_id);
                        }
                    })
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
            ->where(function ($query) {
                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $query->where('account_id', Auth::guard('admin')->user()->account_id);
                }
            })
            ->orderByDesc('partner_rating')
            ->limit(10)
            ->get();

        $data = [
            'users' => DB::table('user')->where(function ($query) {
                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $query->where('account_id', Auth::guard('admin')->user()->account_id);
                }
            })->count(),
            'mitra' => DB::table('partner')->where(function ($query) {
                if (Auth::guard('admin')->user()->roles == 'cabang') {
                    $query->where('account_id', Auth::guard('admin')->user()->account_id);
                }
            })->count(),
            'order' => $orders,
            'widraw' => $totals,
            'rating' => $partners,
        ];

        return response()->json($data);
    }
}
