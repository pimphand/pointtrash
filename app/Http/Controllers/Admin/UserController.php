<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\OrderData;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(User::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                    AllowedFilter::exact('status'),
                ])
                ->orderBy('date_create', 'desc')->paginate($request->per_page ?? 15);

            $total = User::groupBy('status')->selectRaw('count(*) as total, status')->get();

            return response()->json([
                'data' => $data,
                'filter' => $total,
            ]);
        }

        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string',
        ])->validate();

        $user = User::create($validated);

        return response()->json($user);
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
        $user = User::findOrfail($id);

        return view('admin.users.show', compact('user'));
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
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'birth' => 'required|date',
        ]);

        $user = User::findOrfail($id);
        $validated['date_update'] = now();
        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrfail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }

    /**
     * Export data to excel
     */
    public function export($export)
    {
        if ($export == 'excel') {
            return Excel::download(new UsersExport, 'users.xlsx');
        }

        if ($export === 'pdf') {
            // Ambil semua pengguna dari database
            $perPage = 100;

            // Hitung total halaman
            $totalUsers = DB::table('user')->count();
            $totalPages = ceil($totalUsers / $perPage);

            // Inisialisasi array untuk menyimpan nama file PDF
            $pdfFiles = [];

            // Loop melalui setiap halaman dan buat PDF
            for ($page = 1; $page <= $totalPages; $page++) {
                $offset = ($page - 1) * $perPage;
                $users = DB::table('user')
                    ->offset($offset)
                    ->limit($perPage)
                    ->select('name', 'email', 'phone', 'address')
                    ->get();

                $pdf = Pdf::loadView('exports.user_pdf', compact('users'))
                    ->setOption('isRemoteEnabled', true)
                    ->setOption('isHtml5ParserEnabled', true)
                    ->setOption('defaultFont', 'sans-serif');

                // Set paper size and orientation
                $pdf->setPaper('a4', 'portrait');

                // Buat nama file untuk halaman ini
                $filename = 'users-page-'.$page.'-'.time().'.pdf';
                $pdf->save(public_path('pdfs/'.$filename));

                // Simpan nama file ke dalam array
                $pdfFiles[] = $filename;
            }

            // Gabungkan semua file PDF menjadi satu
            $pdf = Pdf::loadView('exports.user_pdf', compact('pdfFiles'))
                ->setOption('isRemoteEnabled', true)
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('defaultFont', 'sans-serif');

            // Set paper size and orientation
            $pdf->setPaper('a4', 'portrait');

            // Simpan file PDF gabungan
            $filename = 'users-'.time().'.pdf';
            $pdf->save(public_path('pdfs/'.$filename));

            // Hapus file PDF sementara

        } else {
            // Jika parameter tidak sesuai
            return response()->json([
                'error' => 'Invalid export type.',
            ], 400);
        }
    }

    public function getData(Request $request, $user_id)
    {
        $data = QueryBuilder::for(OrderData::whereUserId($user_id))
            ->allowedFilters([
                AllowedFilter::scope('search', 'search'),
                AllowedFilter::exact('status'),
            ])
            ->orderBy('date_create', 'desc')->paginate($request->per_page ?? 15);

        return response()->json([
            'data' => $data,
        ]);
    }
}
