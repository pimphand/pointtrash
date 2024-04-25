<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutSite extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'about_id';
    protected $table = 'about_site';
    protected $keyType = 'string';
    public $timestamps = false;
}
