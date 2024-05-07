<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
     * @return Collection
     */
    public function view(): View
    {
        return view('exports.user', [
            'users' => User::all(),
        ]);
    }
}
