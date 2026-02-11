<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // ← implements MustVerifyEmail حذف شد
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * فیلدهای قابل پر شدن
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "phone",
        "address",
        "is_admin",
    ];

    /**
     * فیلدهای مخفی
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * تبدیل نوع داده‌ها
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "is_admin"          => "boolean",
        "phone"             => "string",
        "address"           => "string",
    ];

    /**
     * رابطه با سفارشات
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * رابطه با کامنت‌ها
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * بررسی نقش ادمین
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}