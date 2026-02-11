@extends("layouts.app")
@section("title", "پرداخت نهایی | LINKSA")

@php
    $cart = session('cart', []);
    $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
@endphp

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6 flex items-center justify-center">
    <div class="max-w-4xl w-full">

        <!-- هدر پرداخت -->
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-3xl">
                پرداخت نهایی
            </h1>
            <p class="text-3xl text-gray-700 mt-6 font-bold">
                فقط یه قدم تا تکمیل خریدت مونده
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- فرم پرداخت — کارت بانکی خفن -->
            <div data-aos="fade-right" data-aos-delay="200">
                <div class="bg-gradient-to-br from-purple-600 via-pink-600 to-indigo-700 rounded-3xl shadow-2xl p-10 text-white relative overflow-hidden">
                    <!-- افکت کارت اعتباری -->
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-10 left-10 w-96 h-96 bg-white/20 rounded-full blur-3xl"></div>
                        <div class="absolute bottom-10 right-10 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    </div>

                    <div class="relative z-10">
                        <!-- لوگو بانک -->
                        <div class="flex justify-between items-start mb-12">
                            <div class="bg-white/20 backdrop-blur-lg rounded-2xl px-6 py-3">
                                <span class="text-2xl font-black tracking-wider">LINKSA PAY</span>
                            </div>
                            <svg class="w-16 h-16 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <!-- شماره کارت -->
                        <div class="font-mono text-3xl tracking-widest mb-12 letter-spacing">
                            **** **** **** 3456
                        </div>

                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-sm opacity-80">دارنده کارت</p>
                                <p class="text-xl font-black">مشتری عزیز لینکسا</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm opacity-80">اعتبار تا</p>
                                <p class="text-xl font-black">12 / 29</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- فرم پرداخت -->
                <form action="{{ route('payment.verify') }}" method="POST" class="mt-10 bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-purple-100">
                    @csrf
                    <h2 class="text-3xl font-black text-gray-800 mb-8 text-center">اطلاعات پرداخت</h2>

                    <div class="space-y-8">
                        <div class="group">
                            <label class="text-xl font-bold text-gray-700 group-focus-within:text-purple-600 transition">شماره کارت</label>
                            <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19"
                                   class="mt-4 w-full py-5 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl text-lg font-mono tracking-wider"
                                   required>
                        </div>

                        <div class="grid grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-xl font-bold text-gray-700 group-focus-within:text-purple-600 transition">CVV2</label>
                                <input type="text" name="cvv2" placeholder="123" maxlength="4"
                                       class="mt-4 w-full py-5 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl text-lg text-center font-mono"
                                       required>
                            </div>
                            <div class="group">
                                <label class="text-xl font-bold text-gray-700 group-focus-within:text-purple-600 transition">تاریخ انقضا</label>
                                <input type="text" name="expiry" placeholder="MM/YY"
                                       class="mt-4 w-full py-5 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl text-lg text-center font-mono"
                                       required>
                            </div>
                        </div>

                        <!-- جمع کل -->
                        <div class="bg-gradient-to-r from-purple-100 to-pink-100 rounded-3xl p-8 text-center">
                            <p class="text-2xl text-gray-700 font-bold">مبلغ قابل پرداخت:</p>
                            <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mt-4">
                                {{ number_format($total) }}
                                <span class="text-3xl text-gray-700">تومان</span>
                            </p>
                        </div>

                        <!-- دکمه پرداخت -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-black text-3xl py-8 rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-500 flex items-center justify-center gap-6">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h10m-8 4h6a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            پرداخت امن و نهایی
                        </button>
                    </div>

                    <div class="mt-10 text-center">
                        <div class="flex items-center justify-center gap-4 text-gray-600">
                            <svg class="w-8 h-8 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm4-1a1 1 0 011-1h4a1 1 0 110 2h-4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-bold">پرداخت ۱۰۰٪ امن با درگاه بانک ملی</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- خلاصه سبد خرید -->
            <div data-aos="fade-left" data-aos-delay="400">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-purple-100">
                    <h2 class="text-4xl font-black text-gray-800 mb-8 flex items-center gap-4">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        خلاصه سفارش
                    </h2>

                    <div class="space-y-6 max-h-96 overflow-y-auto">
                        @foreach($cart as $id => $item)
                            <div class="flex items-center gap-6 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl hover:shadow-xl transition-all duration-300">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                     class="w-24 h-24 object-cover rounded-2xl shadow-lg">
                                <div class="flex-1">
                                    <h3 class="text-xl font-black text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-purple-600 font-bold mt-2">
                                        {{ number_format($item['price']) }} تومان
                                        × {{ $item['quantity'] }}
                                    </p>
                                </div>
                                <p class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($item['price'] * $item['quantity']) }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 pt-8 border-t-4 border-dashed border-purple-300">
                        <div class="flex justify-between items-center">
                            <p class="text-4xl font-black text-gray-800">جمع کل:</p>
                            <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600">
                                {{ number_format($total) }} تومان
                            </p>
                        </div>
                    </div>

                    <div class="mt-10 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-3xl p-8 text-center">
                        <p class="text-2xl font-black text-emerald-700">
                            ارسال رایگان برای سفارشات بالای ۵۰۰,۰۰۰ تومان
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- لوگو کوچک پایین -->
        <div class="text-center mt-20">
            <p class="text-2xl font-black text-gray-600">
                با افتخار از <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">LINKSA</span> خرید می‌کنید
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000 });
</script>
@endsection