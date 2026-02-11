<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();   // ایمیل کاربر
            $table->string('code');              // کد OTP
            $table->timestamp('expires_at');     // زمان انقضا
            $table->timestamps();                // created_at و updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_verifications');
    }
};