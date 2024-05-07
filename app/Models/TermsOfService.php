<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsOfService extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'tos_id';

    protected $table = 'terms_of_service';
}
