@extends('layouts.app')
@section('title', $category->name . ' | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-20 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- هدر دسته‌بندی — خفن‌ترین چیزی که تا حالا دیدی -->
        <div class="text-center mb-20" data-aos="fade-down" data-aos-duration="1200">
            <h1 class="text-8xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-4xl leading-tight">
                {{ $category->name }}
            </h1>
            <p class="text-4xl font-bold text-gray-700 mt-8">
                {{ $products->total() }} محصول دست‌چین شده و فوق‌العاده
            </p>
            <div class="w-96 h-2 bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 mx-auto mt-8 rounded-full shadow-2xl"></div>
        </div>

        <!-- وقتی محصول داره -->
        @if($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach($products as $product)
                    <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-purple-100 transform hover:-translate-y-8 hover:shadow-purple-500/50 transition-all duration-700"
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                        <!-- تصویر محصول با افکت زوم و گرادیان -->
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-80 object-cover transition-all duration-1000 group-hover:scale-125">

                            <!-- لایه گرادیان روی عکس -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                            <!-- قیمت روی عکس -->
                            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transform translate-y-10 group-hover:translate-y-0 transition-all duration-700">
                                <p class="text-4xl font-black text-white drop-shadow-2xl">
                                    {{ number_format($product->price) }}
                                    <span class="text-xl">تومان</span>
                                </p>
                            </div>
                        </div>

                        <!-- محتوای کارت -->
                        <div class="p-8 text-center">
                            <h3 class="text-2xl font-black text-gray-800 mb-4 line-clamp-2 group-hover:text-purple-700 transition">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-6">
                                {{ Str::limit($product->description, 100) }}
                            </p>

                            <!-- دکمه افزودن به سبد — خفن‌ترین دکمه تاریخ -->
                            <button onclick="addToCart({{ $product->id }})"
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl py-6 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500 flex items-center justify-center gap-4 group">
                                <svg class="w-10 h-10 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 0 0 0-4zm-8 2a2 2 0 11-4 0 2 2 0 0 0 0z"/>
                                </svg>
                                افزودن به سبد
                            </button>

                            <!-- لینک جزئیات محصول -->
                            <a href="{{ route('products.show', $product) }}"
                               class="block mt-4 text-purple-600 hover:text-pink-600 font-bold text-lg underline-offset-4 hover:underline transition">
                                مشاهده جزئیات
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- صفحه‌بندی خفن -->
            <div class="mt-20 text-center" data-aos="fade-up">
                {{ $products->links() }}
            </div>

        @else
            <!-- وقتی محصولی نیست -->
            <div class="text-center py-32" data-aos="zoom-in" data-aos-duration="1200">
                <div class="w-64 h-64 mx-auto mb-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="text-6xl font-black text-gray-700 mb-8">
                    هنوز محصولی در این دسته اضافه نشده!
                </p>
                <p class="text-3xl text-gray-600 mb-12">
                    به زودی بهترین محصولات رو اینجا می‌بینی
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500">
                    برگرد به فروشگاه
                </a>
            </div>
        @endif
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000, easing: 'ease-out-quart' });
</script>
@endsection