@extends('layouts.app')
@section('title', 'ویرایش محصول | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 flex items-center justify-center px-4 py-16 relative overflow-hidden">

    <!-- پس‌زمینه جادویی -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="w-full max-w-4xl relative z-10">
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-10">

            <!-- عنوان اصلی -->
            <div class="text-center mb-12">
                <h1 class="text-6xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                    ویرایش محصول
                </h1>
                <p class="text-2xl font-bold text-gray-700 mt-4">بهترین نسخه از «{{ $product->name }}» رو بساز</p>
            </div>

            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- نام محصول -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">نام محصول</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium"
                        placeholder="نام کامل و جذاب محصول" />
                    @error('name')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- دسته‌بندی -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">دسته‌بندی</label>
                    <select name="category_id"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium">
                        <option value="">-- بدون دسته‌بندی --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- توضیحات -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">توضیحات کامل</label>
                    <textarea name="description" rows="7"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium resize-none"
                        placeholder="هر چی مشتری باید بدونه...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- قیمت -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">قیمت (تومان)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium text-center"
                        placeholder="۱۲۵۰۰۰۰۰" />
                    @error('price')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تصویر فعلی + آپلود جدید -->
                <div class="grid md:grid-cols-2 gap-10">
                    <!-- تصویر فعلی -->
                    <div>
                        <label class="block text-2xl font-black text-gray-800 mb-4">تصویر فعلی</label>
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-full max-h-96 object-cover rounded-3xl shadow-2xl border-4 border-purple-200">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl flex items-center justify-center">
                                <p class="text-white font-black text-2xl">تصویر فعلی</p>
                            </div>
                        </div>
                    </div>

                    <!-- آپلود تصویر جدید -->
                    <div>
                        <label class="block text-2xl font-black text-gray-800 mb-4">تصویر جدید (اختیاری)</label>
                        <div class="border-4 border-dashed border-purple-300 rounded-3xl p-12 text-center hover:border-purple-500 transition-all duration-300 cursor-pointer bg-purple-50/50">
                            <input type="file" name="image" accept="image/*"
                                   class="hidden" id="new-image-upload" onchange="previewNewImage(event)">
                            <label for="new-image-upload" class="cursor-pointer">
                                <svg class="w-20 h-20 mx-auto text-purple-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-xl font-bold text-gray-700">کلیک کن یا بکش اینجا</p>
                                <p class="text-gray-500 mt-2">JPG, PNG — حداکثر ۵ مگابایت</p>
                            </label>
                        </div>
                        <div id="new-image-preview" class="mt-6 hidden">
                            <img id="new-preview" class="w-full max-h-96 object-cover rounded-3xl shadow-2xl border-4 border-emerald-300" />
                            <p class="text-center text-emerald-600 font-black mt-4 text-xl">این تصویر جدید جایگزین میشه</p>
                        </div>
                        @error('image')
                            <p class="text-red-600 font-bold mt-3 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- دکمه‌ها -->
                <div class="flex flex-col sm:flex-row gap-6 items-center justify-between pt-10 border-t-4 border-purple-200">
                    <a href="{{ route('admin.products.index') }}"
                       class="text-xl font-bold text-gray-600 hover:text-gray-800 transition underline underline-offset-4">
                        انصراف و بازگشت
                    </a>

                    <button type="submit"
                            class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-105 transition-all duration-500 flex items-center justify-center gap-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        به‌روزرسانی محصول
                    </button>
                </div>
            </form>

            <!-- پیام پایانی -->
            <div class="text-center mt-16">
                <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                    LINKSA — همیشه بهترین نسخه از خودش
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function previewNewImage(event) {
    const preview = document.getElementById('new-preview');
    const imagePreview = document.getElementById('new-image-preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    imagePreview.classList.remove('hidden');
}
</script>
@endsection