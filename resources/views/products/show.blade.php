@extends('layouts.app')
@section('title', $product->name . ' | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6">

    <!-- کارت اصلی محصول با انیمیشن ورود -->
    <div class="max-w-7xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <div class="grid lg:grid-cols-2 gap-12 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-purple-100">

            <!-- گالری تصویر محصول (خفن‌ترین قسمت) -->
            <div class="relative overflow-hidden" data-aos="zoom-in" data-aos-delay="200">
                <div class="relative group">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-96 md:h-full object-cover transition-all duration-1000 group-hover:scale-110">

                    <!-- افکت زوم و نور -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

                    <!-- بج‌های انیمیشنی -->
                    @if($product->sold_count > 20)
                        <div class="absolute top-6 left-6 bg-gradient-to-r from-red-600 to-pink-600 text-white px-6 py-3 rounded-full font-black text-lg shadow-2xl animate-pulse">
                            پرفروش
                        </div>
                    @endif
                    @if($product->created_at->gt(now()->subDays(7)))
                        <div class="absolute top-6 right-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-3 rounded-full font-black text-lg shadow-2xl animate-bounce">
                            جدید
                        </div>
                    @endif
                </div>
            </div>

            <!-- جزئیات محصول -->
            <div class="p-8 md:p-12 flex flex-col justify-between" data-aos="fade-left" data-aos-delay="400">
                <div>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-6 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- دسته‌بندی -->
                    @if($product->category)
                        <div class="mb-6">
                            <span class="text-gray-500 font-medium">دسته‌بندی:</span>
                            <a href="{{ route('categories.show', $product->category) }}"
                               class="inline-block bg-purple-100 text-purple-800 px-5 py-2 rounded-full font-bold ml-3 hover:bg-purple-600 hover:text-white transition shadow-md">
                                {{ $product->category->name }}
                            </a>
                        </div>
                    @endif

                    <p class="text-gray-700 text-lg leading-relaxed mb-8 text-justify">
                        {{ $product->description }}
                    </p>

                    <!-- قیمت خفن -->
                    <div class="mb-10">
                        <span class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                            {{ number_format($product->price) }}
                        </span>
                        <span class="text-3xl text-gray-600 font-bold ml-2">تومان</span>
                    </div>
                </div>

                <!-- دکمه افزودن به سبد خرید + پیام -->
                <div>
                    <button onclick="addToCart({{ $product->id }})"
                            class="w-full bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white font-black text-xl py-5 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-105 hover:-translate-y-2 transition-all duration-300 flex items-center justify-center gap-4 group">
                        <svg class="w-8 h-8 group-hover:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100-4 2 2 0 000 4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        افزودن به سبد خرید
                    </button>

                    <div id="add-to-cart-message" class="hidden mt-4 text-center text-green-600 font-bold text-xl bg-green-50 border-2 border-green-300 rounded-2xl py-4 animate-bounce">
                        محصول با موفقیت به سبد خرید اضافه شد!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- محصولات مشابه با اسلایدر خفن -->
    @if(isset($relatedProducts) && $relatedProducts->count())
    <div class="max-w-7xl mx-auto mt-24" data-aos="fade-up">
        <h2 class="text-4xl font-black text-center mb-12 text-gray-800">
            محصولات مشابه از <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">LINKSA</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $item)
                <div class="group bg-white/70 backdrop-blur-md rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transform hover:-translate-y-6 transition-all duration-500 cursor-pointer"
                     onclick="window.location='{{ route('products.show', $item) }}'"
                     data-aos="flip-left" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                             class="w-full h-56 object-cover group-hover:scale-125 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-800 group-hover:text-purple-700 transition line-clamp-2">
                            {{ $item->name }}
                        </h3>
                        <p class="text-2xl font-black text-purple-600 mt-4">
                            {{ number_format($item->price) }} <span class="text-sm text-gray-600">تومان</span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- فرم ثبت نظر -->
    @auth
    <div class="max-w-4xl mx-auto mt-24 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10" data-aos="fade-up">
        <h3 class="text-3xl font-black mb-8 text-gray-800">نظر خود را بنویسید</h3>
        <form action="{{ route('comments.store', $product) }}" method="POST" class="space-y-6">
            @csrf
            <textarea name="body" rows="5" 
                      class="w-full border-2 border-purple-200 rounded-2xl p-6 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition resize-none"
                      placeholder="نظر شما درباره این محصول چیه؟"></textarea>
            @error('body')
                <p class="text-red-500 font-bold">{{ $message }}</p>
            @enderror
            <button type="submit"
                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white font-black px-10 py-4 rounded-2xl shadow-xl hover:shadow-pink-500/50 transform hover:scale-105 transition">
                ارسال نظر
            </button>
        </form>
    </div>
    @else
    <div class="max-w-4xl mx-auto mt-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-3xl p-12 text-center" data-aos="zoom-in">
        <p class="text-2xl font-bold text-gray-800">
            برای ثبت نظر <a href="{{ route('login') }}" class="text-purple-600 underline hover:text-pink-600">وارد شوید</a>
        </p>
    </div>
    @endauth

    <!-- لیست کامنت‌ها -->
    <div class="max-w-5xl mx-auto mt-20">
        <h3 class="text-4xl font-black text-center mb-12">
            نظرات کاربران <span class="text-purple-600">({{ $product->comments->where('parent_id', null)->count() }})</span>
        </h3>
        <div class="space-y-8">
            @forelse($product->comments->where('parent_id', null) as $comment)
                <div class="bg-white/70 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-purple-100"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @include('products.partials.comment', ['comment' => $comment, 'product' => $product, 'depth' => 0])
                </div>
            @empty
                <div class="text-center py-20 bg-white/50 rounded-3xl" data-aos="fade-in">
                    <p class="text-3xl text-gray-500 font-bold">هنوز نظری ثبت نشده!</p>
                    <p class="text-xl text-gray-600 mt-4">اولین نفر باشید</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- اسکریپت‌ها -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    AOS.init({ once: true });

    // تنظیم CSRF برای Axios
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateCartCount(count) {
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            cartCount.textContent = count;
            if (count > 0) cartCount.classList.remove('hidden');
            else cartCount.classList.add('hidden');
        }
    }

    function addToCart(productId) {
        axios.post(`/cart/add/${productId}`)
            .then(res => {
                if (res.data.success) {
                    updateCartCount(res.data.count);
                    const msg = document.getElementById('add-to-cart-message');
                    msg.classList.remove('hidden');
                    setTimeout(() => msg.classList.add('hidden'), 3000);
                } else {
                    alert(res.data.message || 'خطا در افزودن به سبد خرید');
                }
            })
            .catch(err => {
                console.error(err);
                alert('خطا در ارتباط با سرور');
            });
    }
</script>
@endsection