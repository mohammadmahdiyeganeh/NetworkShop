@extends('layouts.app')
@section('title', 'جستجو: ' . ($query ?? 'همه محصولات') . ' | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6">

    <!-- عنوان جستجو با انیمیشن -->
    <div class="text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
        <h1 class="text-5xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
            نتایج جستجو
        </h1>
        <p class="text-2xl md:text-4xl font-bold text-gray-800 mt-6">
            برای:
            <span class="inline-block px-8 py-3 bg-white/70 backdrop-blur-md rounded-2xl shadow-xl text-purple-700 font-black">
                "{{ $query ?? 'همه محصولات' }}"
            </span>
        </p>
        <p class="text-xl text-gray-600 mt-4">
            {{ $products->total() }} محصول یافت شد
        </p>
    </div>

    @if($products->count() > 0)

        <!-- گرید محصولات جستجو — همون استایل صفحه اصلی ولی خفن‌تر -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @foreach($products as $product)
                <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transform hover:-translate-y-8 hover:scale-105 transition-all duration-500 cursor-pointer"
                     onclick="window.location='{{ route('products.show', $product) }}'"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                    <!-- تصویر با افکت زوم و نور -->
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-72 object-cover group-hover:scale-125 transition duration-1000">

                        <!-- بج‌های انیمیشنی -->
                        @if($product->sold_count > 20)
                            <div class="absolute top-4 left-4 bg-gradient-to-r from-red-600 to-pink-600 text-white px-5 py-2 rounded-full font-black text-sm animate-pulse shadow-xl">
                                پرفروش
                            </div>
                        @endif
                        @if($product->created_at->gt(now()->subDays(7)))
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-5 py-2 rounded-full font-black text-sm animate-bounce shadow-xl">
                                جدید
                            </div>
                        @endif

                        <!-- لایه تیره هنگام هاور -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    </div>

                    <!-- محتوا -->
                    <div class="p-6 bg-gradient-to-b from-white to-purple-50">
                        <h3 class="font-extrabold text-xl text-gray-800 group-hover:text-purple-700 transition line-clamp-2 min-h-14">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-3 line-clamp-3 min-h-16">
                            {{ Str::limit($product->description, 90) }}
                        </p>

                        <div class="flex justify-between items-end mt-6">
                            <div>
                                <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($product->price) }}
                                    <span class="text-lg text-gray-600 font-normal">تومان</span>
                                </p>
                            </div>

                            <!-- دکمه افزودن به سبد — چرخشی و بزرگ‌شونده -->
                            <button onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                    class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 rounded-full shadow-2xl hover:shadow-pink-500/50 transform hover:scale-125 hover:rotate-12 transition-all duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100-4 2 2 0 000 4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- صفحه‌بندی خفن و هماهنگ -->
        <div class="max-w-7xl mx-auto mt-20 text-center" data-aos="fade-up">
            {{ $products->appends(['q' => $query])->links() }}
        </div>

    @else
        <!-- وقتی چیزی پیدا نشد — با انیمیشن و ایموجی -->
        <div class="text-center py-32" data-aos="zoom-in" data-aos-duration="1200">
            <div class="text-9xl mb-8">مگس</div>
            <p class="text-4xl font-black text-gray-700 mb-4">هیچ محصولی با این نام پیدا نشد!</p>
            <p class="text-xl text-gray-500">شاید غلط املایی داشتید یا محصول موجود نیست</p>
            <a href="{{ route('home') }}" class="inline-block mt-8 px-12 py-5 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-black text-xl rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-105 transition">
                برگشت به فروشگاه
            </a>
        </div>
    @endif
</div>

<!-- اسکریپت‌ها -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection