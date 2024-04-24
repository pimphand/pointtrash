<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AboutSite extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = Str::snake(Str::pluralStudly(class_basename($this)));
    }
}
