<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }


    public function getName()
    {
        $locale = app()->getLocale();
        if ($locale == 'tm') {
            return $this->name;
        } elseif ($locale == 'en') {
            return $this->name_en ?: $this->name;
        } else {
            return $this->name;
        }
    }
}
