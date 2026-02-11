@extends('layouts.app')
@section('title', 'ویرایش پروفایل | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6">
    <div class="max-w-4xl mx-auto">

        <!-- هدر خفن با انیمیشن -->
        <div class="text-center mb-16" data-aos="fade-down" data-aos-duration="100 magnetite">
            <h1 class="text-6xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                ویرایش پروفایل
            </h1>
            <p class="text-2xl text-gray-700 mt-6 font-bold">
                اینجا می‌تونی همه اطلاعاتتو بروز کنی
            </p>
        </div>

        <!-- کارت اصلی پروفایل -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-purple-100" data-aos="fade-up">
            <div class="p-10 md:p-16">

                @if(session('status') === 'profile-updated')
                    <div class="mb-10 p-8 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black text-xl rounded-2xl shadow-xl text-center flex items-center justify-center gap-4 animate-bounce">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        اطلاعات با موفقیت بروزرسانی شد!
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-10">
                    @csrf @method('PATCH')

                    <!-- نام و نام خانوادگی -->
                    <div class="group">
                        <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">نام و نام خانوادگی</label>
                        <div class="mt-4 relative">
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full text-lg py-5 px-16 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                                   placeholder="مثلاً: علی رضایی">
                            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        @error('name') <p class="text-red-600 font-bold mt-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- ایمیل -->
                    <div class="group">
                        <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">ایمیل</label>
                        <div class="mt-4 relative">
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full text-lg py-5 px-16 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                                   placeholder="مثلاً: ali@example.com">
                            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        @error('email') <p class="text-red-600 font-bold mt-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- شماره تماس -->
                    <div class="group">
                        <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">شماره تماس</label>
                        <div class="mt-4 relative">
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="w-full text-lg py-5 px-16 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                                   placeholder="مثلاً: ۰۹۱۲۳۴۵۶۷۸۹">
                            <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        @error('phone') <p class="text-red-600 font-bold mt-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- آدرس -->
                    <div class="group">
                        <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">آدرس</label>
                        <textarea name="address" rows="4" 
                                  class="mt-4 w-full text-lg py-5 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl resize-none"
                                  placeholder="آدرس کامل پستی...">{{ old('address', $user->address) }}</textarea>
                        @error('address') <p class="text-red-600 font-bold mt-3">{{ $message }}</p> @enderror
                    </div>

                    <!-- رمز عبور جدید (اختیاری) -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="group">
                            <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">رمز عبور جدید (اختیاری)</label>
                            <div class="mt-4 relative">
                                <input type="password" name="password"
                                       class="w-full text-lg py-5 px-16 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                                       placeholder="فقط اگر می‌خوای عوض کنی">
                                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('password') <p class="text-red-600 font-bold mt-3">{{ $message }}</p> @enderror
                        </div>

                        <div class="group">
                            <label class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition">تکرار رمز عبور</label>
                            <div class="mt-4 relative">
                                <input type="password" name="password_confirmation"
                                       class="w-full text-lg py-5 px-16 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                                       placeholder="دوباره وارد کن">
                                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌ها -->
                    <div class="flex flex-col md:flex-row gap-6 pt-10">
                        <button type="submit"
                                class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-16 py-6 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-300">
                            بروزرسانی اطلاعات
                        </button>
                        <a href="{{ route('dashboard') }}"
                           class="bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-black text-2xl px-16 py-6 rounded-2xl shadow-2xl hover:shadow-gray-500/50 transform hover:scale-105 transition-all duration-300 text-center">
                            بازگشت به داشبورد
                        </a>
                    </div>
                </form>

                <!-- بخش حذف حساب با مودال -->
                <div class="mt-20 pt-12 border-t-4 border-red-200">
                    <h3 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-pink-600 mb-8">
                        حذف دائمی حساب کاربری
                    </h3>
                    <p class="text-lg text-gray-600 mb-10 max-w-2xl">
                        با حذف حساب، تمام سفارشات، کامنت‌ها و اطلاعات شما برای همیشه پاک میشه و قابل بازگشت نیست.
                    </p>

                    <button type="button"
                            x-on:click="$dispatch('open-modal', 'confirm-delete-account')"
                            class="bg-gradient-to-r from-red-600 to-pink-700 text-white font-black text-xl px-12 py-6 rounded-2xl shadow-2xl hover:shadow-red-500/50 transform hover:scale-110 transition-all duration-300">
                        حذف دائمی حساب
                    </button>

                    <!-- مودال حذف حساب -->
                    <x-modal name="confirm-delete-account" focusable>
                        <div class="p-10 bg-gradient-to-br from-red-50 via-pink-50 to-purple-50 rounded-3xl shadow-2xl max-w-lg mx-auto text-center">
                            <div class="w-32 h-32 mx-auto bg-red-100 rounded-full flex items-center justify-center animate-pulse mb-8">
                                <svg class="w-20 h-20 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.742-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="text-4xl font-black text-gray-800 mb-6">واقعاً می‌خوای حسابتو حذف کنی؟</h2>
                            <p class="text-xl text-gray-700 mb-10">این عمل غیرقابل بازگشت است!</p>

                            <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-6">
                                @csrf @method('DELETE')
                                <input type="password" name="password" required placeholder="رمز عبور فعلی رو وارد کن..."
                                       class="w-full py-5 px-6 rounded-2xl border-2 border-red-300 focus:border-red-600 focus:ring-4 focus:ring-red-100 text-lg">
                                @error('password') <p class="text-red-600 font-bold">{{ $message }}</p> @enderror

                                <div class="flex justify-center gap-6">
                                    <button type="button" x-on:click="$dispatch('close')" class="px-12 py-5 bg-gray-600 text-white font-black text-xl rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition">
                                        نه، برگردم
                                    </button>
                                    <button type="submit" class="px-14 py-6 bg-gradient-to-r from-red-600 to-pink-700 text-white font-black text-xl rounded-2xl shadow-2xl hover:shadow-red-500/50 transform hover:scale-110 transition">
                                        بله، حذف کن
                                    </button>
                                </div>
                            </form>
                        </div>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection