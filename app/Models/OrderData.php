<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderData extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'order_id';

    protected $table = 'order_data';

    protected $casts = [
        'status' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('order_id', 'like', '%' . $search . '%')
            ->orWhere('user_id', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailOrder::class, 'order_id', 'order_id');
    }

    //partner
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'partner_id');
    }
}
