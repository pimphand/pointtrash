<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'rating_id';

    protected $keyType = 'string';

    protected $guarded = [];

    protected $table = 'rating';
}
