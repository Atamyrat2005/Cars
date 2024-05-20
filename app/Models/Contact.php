<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const UPDATED_AT = null;
}
