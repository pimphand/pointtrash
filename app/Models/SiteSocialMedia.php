<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteSocialMedia extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'site_social_media';
    protected $primaryKey = 'socmed_id';
    public $timestamps = false;
}
