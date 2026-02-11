<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->comment('کاربر صاحب سفارش');
            $table->unsignedBigInteger('total')
                  ->comment('جمع کل به تومان');
            $table->enum('status', ['pending', 'paid', 'cancelled'])
                  ->default('pending')
                  ->comment('وضعیت سفارش');
            $table->timestamps();

            // ایندکس برای جستجوی سریع
            $table->index('user_id', 'orders_user_id_index');
            $table->index('status', 'orders_status_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};