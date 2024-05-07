<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'blog_id';

    protected $table = 'blog';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->blog_id = (string) Str::random(10);
            $blog->seo_title = Str::slug($blog->title);
            $blog->views = 0;
            $blog->date_post = now();
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
