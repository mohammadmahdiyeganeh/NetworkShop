<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->after('total')->constrained('order_statuses');
        });

        // همه سفارش‌های قبلی رو "در حال پردازش" یا "تحویل داده شده" کن (اختیاری)
        \DB::table('orders')->update(['status_id' => 2]); // مثلاً "در حال پردازش"
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};