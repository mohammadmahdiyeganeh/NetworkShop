<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // اگه قبلاً ساخته شده بود، اول حذفش کن
        Schema::dropIfExists('order_statuses');

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // نام وضعیت
            $table->string('color')->default('gray');        // رنگ برای نمایش
            $table->unsignedTinyInteger('step')->unique();   // ترتیب: 1,2,3,4
            $table->timestamps();
        });

        // دیتای اولیه — مثل دیجی‌کالا
        \DB::table('order_statuses')->insert([
            ['name' => 'در انتظار پرداخت',   'color' => 'orange',  'step' => 1],
            ['name' => 'در حال پردازش',     'color' => 'blue',    'step' => 2],
            ['name' => 'ارسال شده',         'color' => 'purple',  'step' => 3],
            ['name' => 'تحویل داده شده',   'color' => 'green',   'step' => 4],
            ['name' => 'لغو شده',           'color' => 'red',     'step' => 5],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};