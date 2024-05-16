<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySaldo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCreatedAtAttribute($key)
    {
        return date('d-M-Y H:i:s', strtotime($key));
    }
}
