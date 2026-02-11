<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\EmailVerification;

class AuthController extends Controller
{
    // مرحله اول: ارسال کد به ایمیل
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $code = rand(100000, 999999); // کد ۶ رقمی

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['code' => $code, 'expires_at' => now()->addMinutes(10)]
        );

        Mail::raw("کد تأیید شما: $code", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('کد تأیید ثبت‌نام');
        });

        return back()->with('status', 'کد تأیید به ایمیل شما ارسال شد.');
    }

    // مرحله دوم: بررسی کد و ساخت کاربر
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
            'name' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if ($record) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $record->delete();

            Auth::login($user); // ورود خودکار بعد از ثبت‌نام
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['code' => 'کد نامعتبر یا منقضی شده است']);
    }
}