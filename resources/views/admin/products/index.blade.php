@extends('layouts.app')
@section('title', 'محصولات | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-12 px-4 sm:px-8">

    <div class="max-w-7xl mx-auto">

        <!-- هدر اصلی -->
        <div class="text-center mb-12">
            <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                مدیریت محصولات
            </h1>
            <p class="text-2xl font-bold text-gray-700 mt-4">همه ستاره‌های LINKSA اینجا هستن</p>
        </div>

        <!-- پیام موفقیت -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-8 py-6 rounded-3xl shadow-2xl flex items-center gap-4 mb-10 transform hover:scale-105 transition-all duration-500">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
                <p class="text-xl font-black">{{ session('success') }}</p>
            </div>
        @endif

        <!-- دکمه‌های سریع -->
        <div class="flex flex-wrap justify-center gap-6 mb-12">
            <a href="{{ route('admin.products.create') }}"
               class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl px-10 py-6 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500 flex items-center gap-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                محصول جدید
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-xl px-10 py-6 rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-110 transition-all duration-500 flex items-center gap-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                مدیریت دسته‌بندی‌ها
            </a>
        </div>

        <!-- جدول محصولات -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-purple-600 to-pink-600 text-white text-right">
                            <th class="p-8 font-black text-xl">تصویر</th>
                            <th class="p-8 font-black text-xl">نام محصول</th>
                            <th class="p-8 font-black text-xl">دسته‌بندی</th>
                            <th class="p-8 font-black text-xl">قیمت</th>
                            <th class="p-8 font-black text-xl">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-b border-purple-100 hover:bg-purple-50/50 transition-all duration-300">
                                <!-- تصویر -->
                                <td class="p-6 text-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="w-24 h-24 object-cover rounded-2xl shadow-xl border-4 border-purple-200 hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-24 h-24 bg-gray-200 border-4 border-dashed border-purple-300 rounded-2xl flex items-center justify-center">
                                            <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                <!-- نام و کد -->
                                <td class="p-6">
                                    <p class="text-2xl font-black text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">کد محصول: #{{ $product->id }}</p>
                                </td>

                                <!-- دسته‌بندی -->
                                <td class="p-6 text-center">
                                    <span class="inline-block px-6 py-3 rounded-full text-lg font-bold
                                        {{ $product->category ? 'bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $product->category?->name ?? 'بدون دسته' }}
                                    </span>
                                </td>

                                <!-- قیمت -->
                                <td class="p-6 text-center">
                                    <p class="text-3xl font-black text-emerald-600">
                                        {{ number_format($product->price) }}
                                        <span class="text-xl text-emerald-700">تومان</span>
                                    </p>
                                </td>

                                <!-- عملیات -->
                                <td class="p-6 space-x-6 space-x-reverse text-center">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300">
                                        ویرایش
                                    </a>

                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('واقعاً می‌خوای «{{ $product->name }}» رو حذف کنی؟ این کار برگشت‌ناپذیره!')"
                                                class="bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-black px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="text-center">
                                        <svg class="w-32 h-32 mx-auto text-purple-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        <p class="text-4xl font-black text-gray-600">هنوز هیچ محصولی اضافه نکردی!</p>
                                        <p class="text-xl text-gray-500 mt-4">بیا با یه محصول جدید، LINKSA رو پر از ستاره کنیم</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- بازگشت به داشبورد -->
        <div class="text-center mt-16">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-4 text-2xl font-bold text-purple-600 hover:text-pink-600 transition">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                بازگشت به داشبورد ادمین
            </a>
        </div>

        <!-- پیام پایانی -->
        <div class="text-center mt-20">
            <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                LINKSA — جایی که هر محصول، یه قصه‌ست
            </p>
        </div>
    </div>
</div>
@endsection