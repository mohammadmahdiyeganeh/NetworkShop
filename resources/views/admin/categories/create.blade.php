@extends('layouts.app')
@section('title', 'افزودن دسته‌بندی | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 flex items-center justify-center px-4 py-16 relative overflow-hidden">

    <!-- پس‌زمینه جادویی -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="w-full max-w-2xl relative z-10">
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-12">

            <!-- عنوان اصلی -->
            <div class="text-center mb-16">
                <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                    دسته‌بندی جدید
                </h1>
                <p class="text-3xl font-bold text-gray-700 mt-6">یه خونه جدید برای محصولات LINKSA</p>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-12">
                @csrf

                <!-- نام دسته‌بندی -->
                <div>
                    <label class="block text-3xl font-black text-gray-800 mb-6 text-center">
                        نام دسته‌بندی رو وارد کن
                    </label>
                    <input type="text" name="name" required
                        class="w-full px-10 py-8 text-2xl text-center font-bold rounded-3xl border-4 border-purple-200 focus:border-purple-600 focus:ring-8 focus:ring-purple-100 transition-all duration-500 shadow-2xl focus:shadow-purple-500/50 placeholder-gray-400"
                        placeholder="مثلاً: لپ‌تاپ گیمینگ، هدفون بی‌سیم، ساعت هوشمند..."
                        value="{{ old('name') }}" />
                    
                    @error('name')
                        <p class="text-red-600 font-black text-xl text-center mt-6 bg-red-100/80 py-4 rounded-2xl border-4 border-red-300">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- دکمه‌ها -->
                <div class="flex flex-col sm:flex-row gap-8 items-center justify-center pt-10">
                    <button type="submit"
                            class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-20 py-10 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500 flex items-center justify-center gap-6">
                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        افزودن دسته‌بندی
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
                       class="w-full sm:w-auto text-center bg-gradient-to-r from-gray-500 to-gray-700 hover:from-gray-600 hover:to-gray-800 text-white font-black text-3xl px-20 py-10 rounded-3xl shadow-2xl hover:shadow-gray-600/50 transform hover:scale-110 transition-all duration-500">
                        انصراف و بازگشت
                    </a>
                </div>
            </form>

            <!-- پیام پایانی -->
            <div class="text-center mt-20 pt-12 border-t-4 border-purple-200">
                <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600">
                    LINKSA — هر دسته‌بندی، یه دنیای جدید
                </p>
            </div>
        </div>
    </div>
</div>
@endsection