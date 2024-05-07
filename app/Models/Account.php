<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected $table = 'account';

    protected $primaryKey = 'account_id';

    protected $keyType = 'string';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getRoleAttribute($value)
    {
        return $value == 1 ? 'Admin' : 'Cabang';
    }
}
