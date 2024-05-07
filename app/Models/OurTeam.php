<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OurTeam extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'team_id';

    protected $table = 'our_team';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($ourTeam) {
            $ourTeam->team_id = (string) Str::random(10);
        });
    }

    //scope search any
    public function scopeSearch($query, $search)
    {
        return $query->whereAny([
            'name',
            'description',
        ], 'LIKE', '%'.$search.'%');
    }
}
