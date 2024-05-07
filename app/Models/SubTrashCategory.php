<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubTrashCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'sub_category_id';

    protected $table = 'sub_trash_category';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->sub_category_id = (string) Str::random(10);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('sub_category', 'like', '%'.$search.'%');
    }

    public function category()
    {
        return $this->belongsTo(TrashCategory::class, 'category_id', 'category_id');
    }
}
