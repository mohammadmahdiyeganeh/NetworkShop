<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'color', 'step'];

    /**
     * سفارش‌هایی که این وضعیت رو دارن
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'status_id');
    }
}