<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status_id',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:0',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    // این متد دقیقاً باید این شکلی باشه — اگر اسمش یا تعریفش اشتباه باشه، خطا می‌ده
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withTrashed()  // برای نمایش محصولات حذف‌شده
            ->withPivot('quantity', 'price', 'image')
            ->withTimestamps();
    }

    // اکسسورهای قشنگ — اینا رو نگه دار
    protected function statusName(): Attribute
    {
        return Attribute::make(get: fn () => $this->status?->name ?? 'نامشخص');
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(get: fn () => $this->status?->color ?? 'gray');
    }

    protected function statusStep(): Attribute
    {
        return Attribute::make(get: fn () => $this->status?->step ?? 1);
    }
}