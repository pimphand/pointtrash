<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteInformation extends Model
{
    use HasFactory;

    protected $primaryKey = "information_id";
    protected $guarded = [];
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = Str::snake(Str::pluralStudly(class_basename($this)));
    }
}
