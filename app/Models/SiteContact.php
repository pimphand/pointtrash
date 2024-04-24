<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteContact extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'contact_id';
    protected $table = 'site_contact';
    public $timestamps = false;
}
