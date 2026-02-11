@extends('layouts.app')
@section('title', 'سبد خرید | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

@php
    $cart = session('cart', []);
    $cart_total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
@endphp

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-20 px-6">
    <div class="max-w-6xl mx-auto">

        <!-- عنوان سبد خرید — خفن‌ترین چیزی که تا حالا دیدی -->
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-8xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-4xl">
                سبد خرید شما
            </h1>
            <p class="text-4xl font-bold text-gray-700 mt-8">
                {{ count($cart) }} مورد در سبدت داری — آماده نهایی کردن؟
            </p>
            <div class="w-96 h-2 bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 mx-auto mt-8 rounded-full shadow-2xl"></div>
        </div>

        <!-- وقتی سبد خالیه -->
        @if(empty($cart))
            <div class="text-center py-32" data-aos="zoom-in" data-aos-duration="1200">
                <div class="w-80 h-80 mx-auto mb-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center shadow-2xl">
                    <svg class="w-48 h-48 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 0 0 0-4zm-8 2a2 2 0 11-4 0 2 2 0 0 0 0z"/>
                    </svg>
                </div>
                <p class="text-7xl font-black text-gray-700 mb-8">
                    سبد خریدت خالیه!
                </p>
                <p class="text-3xl text-gray-600 mb-12">
                    ولی نگران نباش — بهترین محصولات منتظرتن
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-4xl px-20 py-10 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500">
                    برو به فروشگاه و پرش کن!
                </a>
            </div>

        @else
            <!-- لیست محصولات در سبد -->
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- آیتم‌های سبد -->
                <div class="lg:col-span-2 space-y-8">
                    @foreach($cart as $id => $item)
                        <div id="cart-item-{{ $id }}"
                             class="group bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-purple-100 overflow-hidden transform hover:-translate-y-4 hover:shadow-purple-500/50 transition-all duration-700"
                             data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">

                            <div class="flex flex-col sm:flex-row items-center p-8 gap-8">
                                <!-- تصویر محصول -->
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                         alt="{{ $item['name'] }}"
                                         class="w-48 h-48 object-cover rounded-3xl shadow-xl group-hover:scale-110 transition duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition"></div>
                                </div>

                                <!-- جزئیات محصول -->
                                <div class="flex-1 text-center sm:text-right">
                                    <h3 class="text-3xl font-black text-gray-800 mb-4">{{ $item['name'] }}</h3>
                                    <p class="text-xl text-gray-600 mb-6">
                                        قیمت واحد: <span class="font-bold text-purple-600">{{ number_format($item['price']) }} تومان</span>
                                    </p>

                                    <!-- تعداد و جمع جزء -->
                                    <div class="flex items-center justify-center sm:justify-start gap-6 mb-6">
                                        <input type="number" min="1" value="{{ $item['quantity'] }}"
                                               onchange="updateCart({{ $id }}, this.value)"
                                               class="w-28 text-2xl text-center py-4 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 font-bold shadow-lg">
                                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                            ×
                                        </span>
                                        <span id="item-total-{{ $id }}" class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600">
                                            {{ number_format($item['price'] * $item['quantity']) }}
                                        </span>
                                    </div>

                                    <!-- دکمه حذف -->
                                    <button onclick="removeFromCart({{ $id }})"
                                            class="text-red-600 hover:text-red-700 font-black text-xl underline-offset-4 hover:underline transition">
                                        حذف از سبد
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- جمع کل و پرداخت -->
                <div class="lg:col-span-1">
                    <div class="sticky top-28 bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-purple-100 p-10" data-aos="fade-left">
                        <h2 class="text-5xl font-black text-gray-800 mb-10 text-center">خلاصه سفارش</h2>

                        <div class="space-y-8">
                            <div class="flex justify-between text-2xl">
                                <span class="text-gray-600">تعداد محصولات:</span>
                                <span class="font-black text-purple-700">{{ count($cart) }} مورد</span>
                            </div>
                            <div class="flex justify-between text-3xl">
                                <span class="text-gray-700">جمع جزء:</span>
                                <span id="cart-total" class="font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($cart_total) }} تومان
                                </span>
                            </div>

                            <div class="border-t-4 border-dashed border-purple-300 my-10"></div>

                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-3xl p-8 text-center">
                                <p class="text-3xl font-black text-emerald-700 mb-4">مبلغ قابل پرداخت:</p>
                                <p class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600">
                                    {{ number_format($cart_total) }} تومان
                                </p>
                            </div>

                            <a href="{{ route('checkout') }}"
                               class="block text-center bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-black text-4xl py-10 rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-500">
                                تکمیل خرید و پرداخت
                            </a>

                            <div class="mt-8 text-center">
                                <p class="text-xl text-gray-600">
                                    پرداخت ۱۰۰٪ امن با درگاه بانک ملی
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000 });

    // بروزرسانی سبد خرید
    function updateCart(id, quantity) {
        if (!quantity || quantity < 1) quantity = 1;
        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: JSON.stringify({ id, quantity })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                document.getElementById(`item-total-${id}`).textContent = new Intl.NumberFormat('fa-IR').format(data.item_total);
                document.getElementById('cart-total').textContent = new Intl.NumberFormat('fa-IR').format(data.cart_total) + ' تومان';
            }
        });
    }

    function removeFromCart(id) {
        if(!confirm('مطمئنی می‌خوای این محصول رو حذف کنی؟')) return;
        
        fetch(`/cart/remove/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                document.getElementById(`cart-item-${id}`).remove();
                document.getElementById('cart-total').textContent = new Intl.NumberFormat('fa-IR').format(data.cart_total) + ' تومان';
                
                if(data.cart_count === 0){
                    location.reload();
                }
            }
        });
    }
</script>
@endsection