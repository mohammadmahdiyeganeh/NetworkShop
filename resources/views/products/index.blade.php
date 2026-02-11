@extends('layouts.app')
@section('title', 'محصولات | LINKSA')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100">
    <!-- هدر خفن با انیمیشن ورود -->
    <div class="text-center py-16 px-6" data-aos="fade-down" data-aos-duration="1000">
        <h1 class="text-6xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 drop-shadow-2xl animate-pulse">
            LINKSA
        </h1>
        <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-4" data-aos="fade-up" data-aos-delay="300">
            فروشگاه لینکسا — آینده شبکه در دستان شماست
        </p>
        <p class="text-lg text-gray-600 mt-3 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="500">
            بهترین تجهیزات شبکه، سرور، سوئیچ و روتر با گارانتی اصالت و ارسال فوری به سراسر ایران
        </p>
    </div>

    <!-- اسلایدر داینامیک از دیتابیس — دقیقاً مثل قبل ولی از دیتابیس -->
    <div class="relative max-w-7xl mx-auto mb-16 rounded-3xl overflow-hidden shadow-2xl" data-aos="zoom-in" data-aos-duration="1200">
        <div class="swiper mySwiper relative">
            <div class="swiper-wrapper">
                @php
                    $sliders = \App\Models\Slider::where('is_active', true)
                                                ->orderBy('sort_order')
                                                ->get();
                @endphp

                @forelse($sliders as $slider)
                    <div class="swiper-slide relative">
                        <img src="{{ asset('storage/' . $slider->image) }}" 
                             class="w-full h-96 md:h-screen max-h-96 object-cover brightness-75"
                             alt="{{ $slider->title ?? 'اسلایدر' }}">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <div class="text-center px-8">
                                @if($slider->title)
                                    <h2 class="text-5xl md:text-7xl font-black text-white drop-shadow-2xl animate__animated animate__fadeInUp">
                                        {{ $slider->title }}
                                    </h2>
                                @endif
                                @if($slider->subtitle)
                                    <p class="text-3xl md:text-5xl font-bold text-white/90 mt-6 drop-shadow-lg">
                                        {{ $slider->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- اگه اسلایدر نبود، همون قبلی‌ها رو نشون بده -->
                    <div class="swiper-slide relative">
                        <img src="{{ asset('images/rack.webp') }}" class="w-full h-96 md:h-screen max-h-96 object-cover brightness-75">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <h2 class="text-5xl md:text-7xl font-black text-white drop-shadow-2xl animate__animated animate__fadeInUp">
                                LINKSA
                            </h2>
                        </div>
                    </div>
                    <div class="swiper-slide relative">
                        <img src="{{ asset('images/blackfriday.jpg') }}" class="w-full h-96 md:h-screen max-h-96 object-cover brightness-75">
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                            <h2 class="text-5xl md:text-7xl font-black text-yellow-400 drop-shadow-2xl animate-bounce">
                                Black Friday
                            </h2>
                        </div>
                    </div>
                    <div class="swiper-slide relative">
                        <img src="{{ asset('images/takhfif1.png') }}" class="w-full h-96 md:h-screen max-h-96 object-cover brightness-75">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-center pb-20">
                            <h2 class="text-5xl md:text-7xl font-black text-white drop-shadow-2xl">
                                تا 70% تخفیف
                            </h2>
                        </div>
                    </div>
                    <div class="swiper-slide relative">
                        <img src="{{ asset('images/cis.jpg') }}" class="w-full h-96 md:h-screen max-h-96 object-cover brightness-75">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <h2 class="text-5xl md:text-7xl font-black text-white drop-shadow-2xl">
                                Cisco Original
                            </h2>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-button-next text-white hover:text-pink-500 transition"></div>
            <div class="swiper-button-prev text-white hover:text-pink-500 transition"></div>
        </div>
    </div>

    <!-- فیلتر با انیمیشن -->
    @if(Route::is('home') || Route::is('products.index'))
    <div class="max-w-7xl mx-auto px-6 mb-12" data-aos="fade-left" data-aos-duration="800">
        <div class="flex justify-end">
            <select onchange="window.location.href=this.value"
                    class="bg-white/90 backdrop-blur-md border-2 border-purple-300 rounded-2xl px-8 py-4 pr-14 text-lg font-bold text-purple-800 focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-200 transition-all shadow-xl hover:shadow-2xl cursor-pointer">
                <option value="{{ route('products.index', ['sort' => 'newest']) }}" {{ $sort == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                <option value="{{ route('products.index', ['sort' => 'best_selling']) }}" {{ $sort == 'best_selling' ? 'selected' : '' }}>پرفروش‌ترین</option>
                <option value="{{ route('products.index', ['sort' => 'price_low']) }}" {{ $sort == 'price_low' ? 'selected' : '' }}>ارزان‌ترین</option>
                <option value="{{ route('products.index', ['sort' => 'price_high']) }}" {{ $sort == 'price_high' ? 'selected' : '' }}>گران‌ترین</option>
                <option value="{{ route('products.index', ['sort' => 'oldest']) }}" {{ $sort == 'oldest' ? 'selected' : '' }}>قدیمی‌ترین</option>
            </select>
        </div>
    </div>
    @endif

    <!-- گرید محصولات با انیمیشن AOS خفن -->
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        @forelse($products as $product)
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transform hover:-translate-y-6 transition-all duration-500 cursor-pointer"
                 onclick="window.location='{{ route('products.show', $product) }}'"
                 data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- تصویر با افکت زوم و پارالاکس -->
                <div class="relative overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-72 object-cover group-hover:scale-125 transition duration-1000">
                    <!-- بج‌های انیمیشنی -->
                    @if($product->sold_count > 20)
                        <div class="absolute top-4 left-4 bg-red-600 text-white px-4 py-2 rounded-full font-bold text-sm animate-pulse shadow-lg">
                            پرفروش
                        </div>
                    @endif
                    @if($product->created_at->gt(now()->subDays(7)))
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-4 py-2 rounded-full font-bold text-sm animate-bounce shadow-lg">
                            جدید
                        </div>
                    @endif
                </div>
                <!-- محتوا -->
                <div class="p-6 bg-gradient-to-b from-white to-purple-50">
                    <h3 class="font-extrabold text-xl text-gray-800 group-hover:text-purple-700 transition line-clamp-2 min-h-14">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mt-3 line-clamp-2 min-h-12">
                        {{ Str::limit($product->description, 80) }}
                    </p>
                    <div class="flex justify-between items-end mt-6">
                        <div>
                            <div class="flex items-center gap-2 text-yellow-500 mb-2">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                                <span class="text-gray-700 font-bold">{{ $product->sold_count ?? 0 }} فروش</span>
                            </div>
                            <p class="text-3xl font-black text-purple-700">
                                {{ number_format($product->price) }}
                                <span class="text-lg text-gray-600">تومان</span>
                            </p>
                        </div>
                        <!-- دکمه سبد خرید با انیمیشن -->
                        <button onclick="event.stopPropagation(); addToCart({{ $product->id }})"
                                class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 rounded-full shadow-2xl hover:shadow-pink-500/50 transform hover:scale-125 hover:rotate-12 transition-all duration-300 group">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100-4 2 2 0 000 4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-32" data-aos="fade-in">
                <div class="text-9xl mb-8">در حال بارگذاری...</div>
                <p class="text-3xl text-gray-600 font-bold">به زودی محصولات شگفت‌انگیز اضافه می‌شه!</p>
            </div>
        @endforelse
    </div>

    <!-- صفحه‌بندی خفن -->
    @if(method_exists($products, 'links'))
        <div class="max-w-7xl mx-auto mt-20 text-center" data-aos="fade-up">
            {{ $products->links() }}
        </div>
    @endif
</div>

<!-- اسکریپت‌ها -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
    new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        speed: 1200,
        effect: "fade",
        fadeEffect: { crossFade: true },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    });
</script>
@endsection