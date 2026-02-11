<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
   protected $fillable = [
    'product_id',
    'user_id',
    'body',
    'parent_id',
    'approved'
];

protected $casts = [
    'approved' => 'boolean',
];


    // رابطه با محصول
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // رابطه با کاربر
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // کامنت والد
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // پاسخ‌ها (تودرتو)
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->with(['user', 'likes', 'dislikes', 'userLike', 'replies'])
                    ->latest();
    }

    // رابطه لایک‌ها
    public function likes(): HasMany
    {
        return $this->hasMany(CommentLike::class)->where('type', 'like');
    }

    // رابطه دیسلایک‌ها
    public function dislikes(): HasMany
    {
        return $this->hasMany(CommentLike::class)->where('type', 'dislike');
    }

    // وضعیت لایک کاربر فعلی
    public function userLike()
    {
        return $this->hasOne(CommentLike::class)->where('user_id', Auth::id());
    }

    // Accessor: تعداد لایک‌ها
    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }

    // Accessor: تعداد دیسلایک‌ها
    public function getDislikesCountAttribute(): int
    {
        return $this->dislikes()->count();
    }

    // Accessor: آیا کاربر لایک کرده؟
    public function getIsLikedAttribute(): bool
    {
        return $this->userLike && $this->userLike->type === 'like';
    }

    // Accessor: آیا کاربر دیسلایک کرده؟
    public function getIsDislikedAttribute(): bool
    {
        return $this->userLike && $this->userLike->type === 'dislike';
    }
}