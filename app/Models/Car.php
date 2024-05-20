<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }


    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }


    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
