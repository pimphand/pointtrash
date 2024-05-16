<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $table = 'partner';

    protected $keyType = 'string';

    protected $primaryKey = 'partner_id';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($partner) {
            $partner->partner_id = (string) Str::random(10);
            $partner->date_create = now();
            $partner->status = 1;
            $partner->request_status = 0;
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'name',
            'gender',
            'phone',
            'email',
            'address',
            'provinces',
            'regencies',
            'districts',
            'villages',
        ], 'LIKE', '%'.$search.'%');
    }
}
