@extends('layouts.app')
@section('title', 'سفارشات من | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- هدر خفن -->
        <div class="text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="text-6xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
                سفارشات من
            </h1>
            <p class="text-2xl text-gray-700 mt-6 font-bold">
                همه خریدهایت رو اینجا می‌تونی ببینی
            </p>
        </div>

        @if($orders->count())

            <!-- لیست سفارشات — کارت‌های خفن -->
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-purple-100 transform hover:-translate-y-6 hover:shadow-purple-500/50 transition-all duration-700"
                         data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                        <!-- خط بالای کارت با رنگ وضعیت -->
                        <div class="h-3 {{ $order->status == 'paid' ? 'bg-gradient-to-r from-emerald-500 to-teal-600' : 'bg-gradient-to-r from-yellow-500 to-orange-500' }}"></div>

                        <div class="p-8 md:p-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">

                            <!-- سمت چپ: اطلاعات اصلی -->
                            <div class="flex-1">
                                <div class="flex items-center gap-6 mb-6">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl flex items-center justify-center text-white font-black text-3xl shadow-xl">
                                        #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div>
                                        <p class="text-3xl font-black text-gray-800">
                                            سفارش شماره {{ $order->id }}
                                        </p>
                                        <p class="text-lg text-gray-600 mt-2">
                                            {{ $order->created_at->format('d F Y - H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-8 text-lg">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        <span class="font-bold">{{ $order->products->count() }} محصول</span>
                                    </div>
                                </div>
                            </div>

                            <!-- سمت راست: قیمت و وضعیت و دکمه -->
                            <div class="text-center md:text-right space-y-6">
                                <!-- قیمت -->
                                <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($order->total) }}
                                    <span class="text-2xl text-gray-600 font-normal">تومان</span>
                                </p>

                                <!-- وضعیت -->
                                <div class="inline-block px-8 py-4 rounded-full font-black text-xl shadow-xl
                                    {{ $order->status == 'paid' 
                                        ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white' 
                                        : 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white' }}">
                                    {{ $order->status == 'paid' ? 'پرداخت شده' : 'در انتظار پرداخت' }}
                                </div>

                                <!-- دکمه جزئیات -->
                                <a href="{{ route('orders.show', $order) }}"
                                   class="block mt-6 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl px-12 py-5 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-300 inline-block">
                                    مشاهده جزئیات
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- صفحه‌بندی -->
            <div class="mt-16 text-center" data-aos="fade-up">
                {{ $orders->links() }}
            </div>

        @else
            <!-- وقتی سفارشی نیست -->
            <div class="text-center py-32" data-aos="zoom-in" data-aos-duration="1200">
                <div class="w-48 h-48 mx-auto mb-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="text-5xl font-black text-gray-700 mb-8">
                    هنوز سفارشی ثبت نکردی!
                </p>
                <p class="text-2xl text-gray-600 mb-12">
                    وقتشه بری یه چیزی باحال بخری
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500">
                    برو به فروشگاه
                </a>
            </div>
        @endif

        <!-- دکمه بازگشت به داشبورد -->
        <div class="text-center mt-20">
            <a href="{{ route('dashboard') }}"
               class="inline-block bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-black text-white font-black text-xl px-12 py-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition">
                بازگشت به داشبورد
            </a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection