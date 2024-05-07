<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $table = 'service';

    protected $keyType = 'string';

    protected $primaryKey = 'service_id';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($portofolio) {
            $portofolio->service_id = (string) Str::random(10);
        });
    }

    //scope search any
    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'name',
            'description',
        ], 'LIKE', '%'.$search.'%');
    }
}
