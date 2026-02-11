@extends('layouts.app')
@section('title', 'محصول جدید | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 flex items-center justify-center px-4 py-16 relative overflow-hidden">

    <!-- پس‌زمینه جادویی -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="w-full max-w-3xl relative z-10">
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-10">

            <!-- عنوان اصلی -->
            <div class="text-center mb-12">
                <h1 class="text-6xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                    محصول جدید
                </h1>
                <p class="text-2xl font-bold text-gray-700 mt-4">یه ستاره جدید به LINKSA اضافه کن</p>
            </div>

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- نام محصول -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">نام محصول</label>
                    <input type="text" name="name" required
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium"
                        placeholder="مثلاً: هدفون بی‌سیم Sony WH-1000XM5" />
                    @error('name')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- دسته‌بندی -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">دسته‌بندی</label>
                    <select name="category_id"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium">
                        <option value="">-- انتخاب دسته‌بندی --</option>
                        @foreach(\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- توضیحات -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">توضیحات کامل محصول</label>
                    <textarea name="description" rows="6"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium resize-none"
                        placeholder="هر چی که مشتری باید بدونه رو اینجا بنویس..."></textarea>
                    @error('description')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- قیمت -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">قیمت (تومان)</label>
                    <input type="number" name="price" required min="0"
                        class="w-full px-8 py-6 text-xl rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-xl focus:shadow-2xl font-medium text-center"
                        placeholder="مثلاً: ۱۲۵۰۰۰۰۰" />
                    @error('price')
                        <p class="text-red-600 font-bold mt-3">{{ $message }}</p>
                    @enderror
                </div>

                <!-- آپلود تصویر -->
                <div>
                    <label class="block text-2xl font-black text-gray-800 mb-3">تصویر اصلی محصول</label>
                    <div class="border-4 border-dashed border-purple-300 rounded-3xl p-12 text-center hover:border-purple-500 transition-all duration-300 cursor-pointer bg-purple-50/50">
                        <input type="file" name="image" accept="image/*" required class="hidden" id="image-upload" onchange="previewImage(event)">
                        <label for="image-upload" class="cursor-pointer">
                            <svg class="w-20 h-20 mx-auto text-purple-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-xl font-bold text-gray-700">کلیک کن یا تصویر رو بکش اینجا</p>
                            <p class="text-gray-500 mt-2">فقط JPG, PNG — حداکثر ۵ مگابایت</p>
                        </label>
                    </div>
                    <div id="image-preview" class="mt-6 hidden">
                        <img id="preview" class="max-h-96 mx-auto rounded-2xl shadow-2xl" />
                    </div>
                    @error('image')
                        <p class="text-red-600 font-bold mt-3 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <!-- دکمه‌ها -->
                <div class="flex flex-col sm:flex-row gap-6 items-center justify-between pt-10">
                    <a href="{{ route('admin.products.index') }}"
                       class="text-xl font-bold text-gray-600 hover:text-gray-800 transition underline underline-offset-4">
                        انصراف و بازگشت
                    </a>

                    <button type="submit"
                            class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-105 transition-all duration-500 flex items-center justify-center gap-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        ذخیره محصول و انتشار
                    </button>
                </div>
            </form>

            <!-- پیام پایانی -->
            <div class="text-center mt-16 pt-10 border-t-4 border-purple-200">
                <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                    LINKSA — جایی که کیفیت حرف اول رو می‌زنه
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('image-preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    imagePreview.classList.remove('hidden');
}
</script>
@endsection