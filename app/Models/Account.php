<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            $account->account_id = (string) Str::random(10);
            $account->photo = 'user.png';
            $account->level_id = 1;
            $account->point = 0;
        });
    }

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

    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'name',
            'email',
            'phone',
            'username',
        ], 'LIKE', '%' . $search . '%');
    }

    public function historySaldos()
    {
        return $this->hasMany(HistorySaldo::class, 'account_id', 'account_id');
    }
}
