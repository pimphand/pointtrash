<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'detail_order_id';

    protected $table = 'detail_order';

    public function category()
    {
        return $this->belongsTo(SubTrashCategory::class, 'sub_category_id', 'sub_category_id');
    }
}
