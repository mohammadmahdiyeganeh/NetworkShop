<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['image', 'title', 'subtitle', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}