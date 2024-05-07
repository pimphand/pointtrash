<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'user_id';

    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_id = (string) Str::random(10);
            $validated['date_create'] = now();
            $validated['photo'] = 'user.png';
            $validated['status'] = 1;
            $validated['point'] = 0;
            $validated['request_status'] = 0;
            $user->fill($validated);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'name',
            'gender',
            'phone',
            'email',
            'address',
            'provinces',
            'regencies',
            'districts',
            'villages',
        ], 'LIKE', '%'.$search.'%');
    }

    public function orders()
    {
        return $this->hasMany(OrderData::class, 'user_id', 'user_id');
    }
}
