<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WidrawPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $status)
    {
        if ($request->ajax()) {
            if ($status == 'user') {
                $user = WidrawUser::with('user');
            } else {
                $user = WidrawPartner::with('user');
            }
            $data = QueryBuilder::for($user)
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::partial('user.name', 'search'),
                    AllowedFilter::exact('status'),
                ])
                ->where('type', str_replace('_Widraw', '', Str::title($status)))
                ->orderBy('date_request', 'desc');

            if ($request->history == 'true') {
                $data->where('status', 1);
            } else {
                $data->where('status', '=', 0)->Orwhere('status', '=', 2);
            }

            $result = $data->paginate($request->per_page ?? 15);

            return response()->json([
                'data' => $result,
            ]);
        }

        return view('admin.widraws.index', compact('status'));
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
        $data = WidrawUser::with(['user'])->where('widraw_id', $id)->first();

        return view('admin.widraws.show', compact('data', 'type'));
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
        $data = QueryBuilder::for(WidrawUser::with('user'))
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
    public function approve(string $type, $widraw_id, $status)
    {
        try {
            if ($type == 'user') {
                $data = WidrawUser::where('widraw_id', $widraw_id)->first();
                $data->status = $status == 'Approve' ? 1 : 2;
                $data->save();
            } else {
                $data = WidrawPartner::where('widraw_id', $widraw_id)->first();
                $data->status = $status == 'Approve' ? 1 : 2;
                $data->save();
            }

            $token = $data->user->token;
            // URL FCM
            $url = 'https://fcm.googleapis.com/fcm/send';

            // Kunci server FCM
            $serverKey = 'AAAA71K9pOA:APA91bGN0YZvTj5VLu-Auqfpdl1qc7gvKYX1e5TlKYzpJkAHi5oH83gaKAquDVrq4kqx32feoxIXKpzTkFDekCUEEQhA9Cgz44ZT-xQLnsVj_0BLNakUbiu5yy8ReadzEENeIXXgzZsp';

            // Konten notifikasi
            $title = 'Gopay Widraw Sudah Diapprove';
            $body = 'Hai '.$data->user->name.', widraw point kamu sudah diapprove ya!';
            $notification = [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'badge' => '1',
            ];

            // Data yang dikirim ke FCM
            $arrayToSend = [
                'registration_ids' => $token,  // Daftar token perangkat
                'notification' => $notification,
                'priority' => 'high',
            ];

            // Mengirim permintaan POST ke FCM dengan Laravel HTTP Client
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.$serverKey,
            ])->post($url, $arrayToSend);

            return response()->json([
                'messages' => 'Success',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the history of the specified resource.
     */
    public function history(Request $request, $status)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(WidrawUser::with('user'))
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
