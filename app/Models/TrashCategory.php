<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrashCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'category_id';

    protected $table = 'trash_category';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->category_id = (string) Str::random(10);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('category', 'like', '%'.$search.'%');
    }
}
