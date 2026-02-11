@extends('layouts.app')
@section('title', 'دسته‌بندی‌ها | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-12 px-4">

    <div class="max-w-6xl mx-auto">

        <!-- عنوان اصلی -->
        <div class="text-center mb-12">
            <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                دسته‌بندی‌های LINKSA
            </h1>
            <p class="text-3xl font-bold text-gray-700 mt-6">هر دسته، یه دنیای پر از ستاره</p>
        </div>

        <!-- پیام‌های وضعیت -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-10 py-8 rounded-3xl shadow-2xl flex items-center justify-center gap-6 mb-12 transform hover:scale-105 transition-all duration-700">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-2xl font-black">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-rose-500 to-red-600 text-white px-10 py-8 rounded-3xl shadow-2xl flex items-center justify-center gap-6 mb-12 transform hover:scale-105 transition-all duration-700">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <p class="text-2xl font-black">{{ session('error') }}</p>
            </div>
        @endif

        <!-- دکمه افزودن دسته‌بندی -->
        <div class="text-center mb-12">
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center gap-6 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-16 py-10 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500">
                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                افزودن دسته‌بندی جدید
            </a>
        </div>

        <!-- جدول دسته‌بندی‌ها -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white">
                            <th class="px-12 py-10 text-2xl font-black text-right">نام دسته‌بندی</th>
                            <th class="px-12 py-10 text-2xl font-black text-center">تعداد محصولات</th>
                            <th class="px-12 py-10 text-2xl font-black text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-100">
                        @forelse($categories as $category)
                            <tr class="hover:bg-purple-50/70 transition-all duration-500 transform hover:scale-[1.01]">
                                <td class="px-12 py-10 text-right">
                                    <p class="text-3xl font-black text-gray-800">{{ $category->name }}</p>
                                </td>
                                <td class="px-12 py-10 text-center">
                                    <span class="inline-block px-10 py-5 rounded-full text-3xl font-black
                                        {{ $category->products()->count() > 0 
                                            ? 'bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 border-4 border-emerald-300' 
                                            : 'bg-gray-100 text-gray-600 border-4 border-gray-300' }}">
                                        {{ $category->products()->count() }}
                                    </span>
                                </td>
                                <td class="px-12 py-10 text-center">
                                    <div class="flex justify-center gap-8">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xl px-12 py-6 rounded-3xl shadow-xl hover:shadow-indigo-500/50 transform hover:scale-110 transition-all duration-400">
                                            ویرایش
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                              onsubmit="return confirm('واقعاً می‌خوای «{{ $category->name }}» رو حذف کنی؟ همه محصولاتش هم بی‌خونه میشن!')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="bg-gradient-to-r from-rose-600 to-red-700 hover:from-rose-700 hover:to-red-800 text-white font-black text-xl px-12 py-6 rounded-3xl shadow-xl hover:shadow-rose-500/50 transform hover:scale-110 transition-all duration-400">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-32 text-center">
                                    <svg class="w-32 h-32 mx-auto text-purple-300 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>
                                    <p class="text-5xl font-black text-gray-600">هنوز هیچ دسته‌بندی‌ای نساختی</p>
                                    <p class="text-2xl text-gray-500 mt-6">بیا با اولین دسته‌بندی، LINKSA رو منظم و زیبا کنیم</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- بازگشت -->
        <div class="text-center mt-16">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-6 text-3xl font-black text-purple-600 hover:text-pink-600 transition">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                بازگشت به داشبورد ادمین
            </a>
        </div>

        <!-- پیام پایانی -->
        <div class="text-center mt-20">
            <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600">
                LINKSA — نظم در اوج زیبایی
            </p>
        </div>
    </div>
</div>
@endsection