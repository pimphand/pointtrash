<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidrawPartner extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $table = 'widraw_partner';

    protected $primaryKey = 'widraw_id';

    protected $keyType = 'string';

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'partner_id');
    }
}
