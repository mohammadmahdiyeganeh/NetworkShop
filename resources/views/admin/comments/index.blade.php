@extends('layouts.app')
@section('title', 'مدیریت کامنت‌ها | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-12 px-4">

    <div class="max-w-7xl mx-auto">

        <!-- عنوان اصلی -->
        <div class="text-center mb-12">
            <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                صدای مشتریان
            </h1>
            <p class="text-3xl font-bold text-gray-700 mt-6">هر کامنت، یه قلب تپنده برای LINKSA</p>
        </div>

        <!-- پیام موفقیت -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-10 py-8 rounded-3xl shadow-2xl flex items-center justify-center gap-6 mb-12 transform hover:scale-105 transition-all duration-700">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-2xl font-black">{{ session('success') }}</p>
            </div>
        @endif

        <!-- جدول کامنت‌ها -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white">
                            <th class="px-10 py-8 text-2xl font-black text-right">کاربر عاشق</th>
                            <th class="px-10 py-8 text-2xl font-black text-right">محصول</th>
                            <th class="px-10 py-8 text-2xl font-black text-right">متن کامنت</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">وضعیت</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-100">
                        @forelse($comments as $comment)
                            <tr class="hover:bg-purple-50/70 transition-all duration-500 {{ $comment->approved ? 'bg-emerald-50/30' : 'bg-amber-50/30' }}">

                                <!-- کاربر -->
                                <td class="px-10 py-8 text-right">
                                    <p class="text-2xl font-black text-gray-800">{{ $comment->user->name }}</p>
                                    <p class="text-purple-600 font-medium">{{ $comment->user->email }}</p>
                                </td>

                                <!-- محصول -->
                                <td class="px-10 py-8 text-right">
                                    <a href="{{ route('products.show', $comment->product) }}"
                                       class="text-2xl font-black text-purple-700 hover:text-pink-600 transition underline underline-offset-4">
                                        {{ Str::limit($comment->product->name, 40) }}
                                    </a>
                                </td>

                                <!-- متن کامنت -->
                                <td class="px-10 py-8 text-right">
                                    <p class="text-xl leading-relaxed text-gray-700 max-w-2xl">
                                        {{ Str::limit($comment->body, 120) }}
                                    </p>
                                    @if(strlen($comment->body) > 120)
                                        <span class="text-purple-600 font-bold text-sm">... (ادامه در محصول)</span>
                                    @endif
                                </td>

                                <!-- وضعیت -->
                                <td class="px-10 py-8 text-center">
                                    @if($comment->approved)
                                        <span class="inline-block px-10 py-5 rounded-full text-2xl font-black bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 border-4 border-emerald-300 shadow-xl">
                                            تأیید شده
                                        </span>
                                    @else
                                        <span class="inline-block px-10 py-5 rounded-full text-2xl font-black bg-gradient-to-r from-amber-100 to-orange-100 text-orange-800 border-4 border-amber-300 shadow-xl">
                                            در انتظار تأیید
                                        </span>
                                    @endif
                                </td>

                                <!-- عملیات -->
                                <td class="px-10 py-8 text-center space-x-6 space-x-reverse">
                                    @if(!$comment->approved)
                                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-xl px-10 py-6 rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-110 transition-all duration-500">
                                                تأیید کن
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-emerald-700 font-black text-xl">تأیید شده</span>
                                    @endif

                                    <form action="{{ route('admin.comments.reject', $comment) }}" method="POST" class="inline"
                                          onsubmit="return confirm('واقعاً می‌خوای این کامنت رو حذف کنی؟ این کار برگشت‌ناپذیره!')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-black text-xl px-10 py-6 rounded-3xl shadow-2xl hover:shadow-rose-500/50 transform hover:scale-110 transition-all duration-500">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-32 text-center">
                                    <svg class="w-32 h-32 mx-auto text-purple-300 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <p class="text-5xl font-black text-gray-600">هنوز هیچ کامنتی ثبت نشده</p>
                                    <p class="text-2xl text-gray-500 mt-6">اولین کامنت که بیاد، اینجا پر از عشق و انرژی میشه</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- صفحه‌بندی -->
            <div class="p-8 bg-gradient-to-r from-purple-50 to-pink-50 rounded-b-3xl">
                <div class="flex justify-center">
                    {{ $comments->onEachSide(3)->links() }}
                </div>
            </div>
        </div>

        <!-- بازگشت -->
        <div class="text-center mt-16">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-6 text-3xl font-black text-purple-600 hover:text-pink-600 transition">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                بازگشت به داشبورد
            </a>
        </div>

        <!-- پیام پایانی -->
        <div class="text-center mt-20">
            <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600">
                LINKSA — جایی که هر نظر، ارزشمنده
            </p>
        </div>
    </div>
</div>
@endsection