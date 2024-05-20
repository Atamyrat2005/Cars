<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Year extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
