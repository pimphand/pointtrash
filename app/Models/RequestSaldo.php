<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestSaldo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('saldo', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orWhere('type', 'like', '%'.$search.'%')
            ->orWhere('created_at', 'like', '%'.$search.'%')
            ->orWhereHas('account', function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%');
            });
    }
}
