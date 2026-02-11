@extends('layouts.app')

@section('title', 'داشبورد ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">

        <!-- عنوان اصلی -->
        <div class="text-center mb-12">
            <h1 class="text-6xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                داشبورد مدیریت
            </h1>
            
        </div>

        <!-- کارت‌های آمار کلی -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

            <!-- فروش امروز -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium">فروش امروز</p>
                        <p class="text-4xl font-black text-emerald-600 mt-3">
                            {{ number_format(\App\Models\Order::whereDate('created_at', today())->sum('total')) }}
                            <span class="text-xl">تومان</span>
                        </p>
                    </div>
                    <div class="bg-emerald-100 p-5 rounded-full">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- سفارشات جدید -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium">سفارشات جدید</p>
                        <p class="text-4xl font-black text-purple-600 mt-3">
                            {{ \App\Models\Order::whereIn('status_id', [1, null])->count() }}
                        </p>
                    </div>
                    <div class="bg-purple-100 p-5 rounded-full">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- تعداد محصولات -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium">محصولات فروشگاه</p>
                        <p class="text-4xl font-black text-pink-600 mt-3">
                            {{ \App\Models\Product::count() }}
                        </p>
                    </div>
                    <div class="bg-pink-100 p-5 rounded-full">
                        <svg class="w-12 h-12 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- کاربران -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-8 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 font-medium">کاربران ثبت‌نامی</p>
                        <p class="text-4xl font-black text-indigo-600 mt-3">
                            {{ \App\Models\User::count() }}
                        </p>
                    </div>
                    <div class="bg-indigo-100 p-5 rounded-full">
                        <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- دکمه‌های سریع -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <a href="{{ route('admin.orders.index') }}" class="block group">
                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-3">سفارشات</h3>
                    <p class="text-gray-600">مدیریت و تغییر وضعیت سفارشات</p>
                </div>
            </a>

            <a href="{{ route('admin.products.index') }}" class="block group">
                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-3">محصولات</h3>
                    <p class="text-gray-600">افزودن، ویرایش و حذف محصولات</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="block group">
                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-3">دسته‌بندی‌ها</h3>
                    <p class="text-gray-600">مدیریت دسته‌بندی محصولات</p>
                </div>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="block group">
                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-rose-500 to-pink-500 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-3">کامنت‌ها</h3>
                    <p class="text-gray-600">بررسی و تأیید نظرات کاربران</p>
                </div>
            </a>
        </div>

        <!-- کامنت‌ها -->
<a href="{{ route('admin.comments.index') }}" class="block group">
    ...
</a>



<!-- مدیریت کاربران — اینو اینجا بذار -->
<a href="{{ route('admin.users.index') }}" class="block group">
    <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
            <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-2xl font-black text-gray-800 mb-3">کاربران</h3>
        <p class="text-gray-600">مدیریت، ویرایش و حذف کاربران</p>
    </div>
</a>

<a href="{{ route('admin.sliders.index') }}" class="block group">
    <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-white/50">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center shadow-xl group-hover:shadow-2xl">
            <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M3 7h4l2-3h6l2 3h4v13H3V7z" />
  <circle cx="12" cy="13" r="4" stroke="currentColor" stroke-width="2" />
</svg>
        </div>
        <h3 class="text-2xl font-black text-gray-800 mb-3">اسلایدر</h3>
        <p class="text-gray-600">مدیریت اسلایدر</p>
    </div>
</a>

        <!-- بازگشت به فروشگاه -->
        <div class="text-center mt-16">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-xl font-bold text-purple-600 hover:text-pink-600 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                بازگشت به فروشگاه
            </a>
        </div>

        <!-- پیام پایانی -->
        <div class="text-center mt-12">
            <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                LINKSA — همیشه در اوج
            </p>
        </div>
    </div>
</div>
@endsection