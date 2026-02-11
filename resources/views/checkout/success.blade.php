@extends('layouts.app')
@section('title', 'پرداخت موفق | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-100 py-16 px-6 flex items-center justify-center relative overflow-hidden">

    <!-- پس‌زمینه انیمیشنی جشن -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-emerald-300/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-teal-300/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-cyan-300/20 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-2xl w-full text-center relative z-10">

        <!-- آیکون موفقیت بزرگ با انیمیشن -->
        <div data-aos="zoom-in" data-aos-duration="1000">
            <div class="w-48 h-48 mx-auto bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center shadow-2xl animate-bounce">
                <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <!-- عنوان اصلی -->
        <div data-aos="fade-up" data-aos-delay="600">
            <h1 class="text-7xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 drop-shadow-3xl mt-12">
                پرداخت موفق!
            </h1>
            <p class="text-4xl md:text-5xl font-black text-gray-800 mt-8">
                تبریک می‌گم قهرمان
            </p>
            <p class="text-2xl text-gray-700 mt-6">
                خریدت با موفقیت انجام شد و سفارش در حال آماده‌سازیه
            </p>
        </div>

        <!-- اطلاعات سفارش -->
        <div class="mt-16 bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border border-emerald-100" data-aos="fade-up" data-aos-delay="800">
            @if(session('order_id'))
                <div class="mb-8">
                    <p class="text-2xl text-gray-600">شماره سفارش شما:</p>
                    <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 mt-4">
                        #{{ str_pad(session('order_id'), 6, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            @endif

            @if(session('total'))
                <div class="mb-10">
                    <p class="text-2xl text-gray-600">مبلغ پرداختی:</p>
                    <p class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600 mt-4">
                        {{ number_format(session('total')) }}
                        <span class="text-4xl text-gray-700">تومان</span>
                    </p>
                </div>
            @endif

            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-3xl p-8">
                <p class="text-2xl font-black text-emerald-700">
                    ایمیل تأیید به آدرس زیر ارسال شد:
                </p>
                <p class="text-3xl font-black text-gray-800 mt-4">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <!-- دکمه‌های اقدام -->
        <div class="mt-16 flex flex-col sm:flex-row gap-8 justify-center items-center" data-aos="fade-up" data-aos-delay="1000">
            <a href="{{ route('dashboard') }}"
               class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-purple-500/50 transform hover:scale-110 transition-all duration-500 flex items-center gap-6">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6a1 1 0 001-1v-4"/>
                </svg>
                بازگشت به داشبورد
            </a>

            @if(session('order_id'))
                <a href="{{ route('orders.show', session('order_id')) }}"
                   class="bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-black text-3xl px-16 py-8 rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-110 transition-all duration-500 flex items-center gap-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    مشاهده جزئیات سفارش
                </a>
            @endif
        </div>

        <!-- پیام پایانی عاشقانه -->
        <div class="mt-20" data-aos="fade-up" data-aos-delay="1200">
            <p class="text-4xl font-black text-gray-700">
                ممنون که به <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">LINKSA</span> اعتماد کردی
            </p>
            <p class="text-2xl text-gray-600 mt-6">
                سفارش شما به زودی ارسال میشه — منتظر یه بسته پر از عشق باش!
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1200 });

    // افکت جشن کوچک (کنفتی!)
    setTimeout(() => {
        const confetti = document.createElement('div');
        confetti.innerHTML = '🎉';
        confetti.classList.add('fixed', 'top-10', 'left-1/2', '-translate-x-1/2', 'text-9xl', 'animate-bounce', 'z-50');
        document.body.appendChild(confetti);
        setTimeout(() => confetti.remove(), 3000);
    }, 1000);
</script>
@endsection