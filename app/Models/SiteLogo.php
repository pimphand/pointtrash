<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteLogo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'site_logo';
    protected $primaryKey = 'logo_id';

    public $timestamps = false;
}
