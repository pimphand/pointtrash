<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $table = 'banner';

    protected $primaryKey = 'banner_id';

    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($banner) {
            $banner->banner_id = (string) Str::random(10);
            $banner->date_post = now();
        });
    }

    //scope search any
    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'link',
        ], 'LIKE', '%' . $search . '%');
    }
}
