<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Advertisment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'advertisment_id';

    protected $table = 'advertisment';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($advertisment) {
            $advertisment->advertisment_id = (string) Str::random(10);
            $advertisment->date_post = now();
        });
    }

    //scope search any
    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'link',
        ], 'LIKE', '%'.$search.'%');
    }
}
