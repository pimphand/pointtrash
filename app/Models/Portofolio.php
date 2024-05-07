<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portofolio extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $table = 'portofolio';

    protected $primaryKey = 'portofolio_id';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($portofolio) {
            $portofolio->portofolio_id = (string) Str::random(10);
        });

        static::deleting(function ($portofolio) {
            if ($portofolio->thumbnail) {
                unlink(public_path('upload/'.$portofolio->thumbnail));
            }
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'title',
            'type',
            'embed_code',
        ], 'LIKE', '%'.$search.'%');
    }
}
