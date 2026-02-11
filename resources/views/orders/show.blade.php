@extends('layouts.app')
@section('title', 'سفارش #' . $order->id . ' | LINKSA')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- هدر خفن با انیمیشن -->
        <div class="text-center mb-16" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="text-7xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-3xl">
                سفارش شماره {{ $order->id }}
            </h1>
            <p class="text-3xl text-gray-700 mt-8 font-bold">
                {{ $order->created_at->format('l، d F Y - H:i') }}
            </p>
        </div>

        <!-- نوار پیشرفت وضعیت — مثل دیجی‌کالا ولی ۱۰ برابر خفن‌تر -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-12 mb-12 overflow-hidden border border-purple-100" data-aos="fade-up">
            <h2 class="text-4xl font-black text-center mb-12 text-gray-800">وضعیت فعلی سفارش</h2>

            @php
                $currentStep = $order->status?->step ?? 1;
                $steps = \App\Models\OrderStatus::orderBy('step')->get();
            @endphp

            <div class="relative">
                <div class="flex justify-between items-center relative">
                    @foreach($steps as $step)
                        @php
                            $isCompleted = $currentStep > $step->step;
                            $isActive = $currentStep == $step->step;
                        @endphp
                        <div class="flex flex-col items-center z-10">
                            <div class="relative">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center text-white font-black text-2xl shadow-2xl transition-all duration-700
                                    {{ $isCompleted ? 'bg-gradient-to-br from-emerald-500 to-teal-600' : ($isActive ? 'bg-gradient-to-br from-purple-600 to-pink-600 ring-8 ring-purple-200 scale-125' : 'bg-gray-300') }}">
                                    @if($isCompleted)
                                        Checkmark
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </div>
                                @if($isActive)
                                    <div class="absolute inset-0 rounded-full animate-ping bg-purple-400 opacity-75"></div>
                                @endif
                            </div>
                            <p class="mt-6 text-lg font-bold {{ $isCompleted || $isActive ? 'text-purple-700' : 'text-gray-500' }}">
                                {{ $step->name }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- خط پیشرفت گرادیان -->
                <div class="absolute top-12 left-0 right-0 h-3 bg-gray-200 rounded-full -z-10">
                    <div class="h-full bg-gradient-to-r from-purple-600 to-pink-600 rounded-full transition-all duration-1500 ease-out shadow-lg"
                         style="width: {{ ($currentStep - 1) / ($steps->count() - 1) * 100 }}%"></div>
                </div>
            </div>

            <!-- وضعیت فعلی بزرگ -->
            <div class="text-center mt-16">
                <span class="inline-block px-12 py-6 rounded-full text-2xl font-black shadow-2xl
                    {{ $order->status?->color == 'green' ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white' :
                       ($order->status?->color == 'orange' ? 'bg-gradient-to-r from-orange-500 to-red-500 text-white' :
                       ($order->status?->color == 'blue' ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white' :
                       'bg-gradient-to-r from-purple-600 to-pink-600 text-white')) }}">
                    {{ $order->status?->name ?? 'در حال پردازش' }}
                </span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 gap-12">

            <!-- محصولات سفارش -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-purple-100" data-aos="fade-right">
                    <h2 class="text-4xl font-black text-gray-800 mb-10 flex items-center gap-4">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        محصولات سفارش شده
                    </h2>

                    <div class="space-y-6">
                        @foreach(json_decode($order->items, true) as $item)
                            <div class="group flex items-center justify-between p-8 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl hover:shadow-2xl hover:shadow-purple-300/50 transform hover:-translate-y-3 transition-all duration-500">
                                <div class="flex items-center gap-8">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                             class="w-28 h-28 object-cover rounded-2xl shadow-xl group-hover:scale-110 transition duration-700">
                                        <div class="absolute -top-3 -right-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-black text-sm px-4 py-2 rounded-full shadow-lg">
                                            ×{{ $item['quantity'] }}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-800">{{ $item['name'] }}</h3>
                                        <p class="text-lg text-gray-600 mt-2">
                                            قیمت واحد: <span class="font-bold text-purple-600">{{ number_format($item['price']) }} تومان</span>
                                        </p>
                                    </div>
                                </div>
                                <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($item['price'] * $item['quantity']) }} <span class="text-xl text-gray-600">تومان</span>
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <!-- جمع کل -->
                    <div class="mt-12 pt-10 border-t-4 border-dashed border-purple-300">
                        <div class="flex justify-between items-center">
                            <p class="text-4xl font-black text-gray-800">جمع کل قابل پرداخت:</p>
                            <p class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-600 drop-shadow-2xl">
                                {{ number_format($order->total) }} <span class="text-3xl text-gray-700">تومان</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- سایدبار اطلاعات + پشتیبانی -->
            <div class="space-y-8">
                <!-- اطلاعات سفارش -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-purple-100" data-aos="fade-left">
                    <h3 class="text-3xl font-black text-gray-800 mb-8">اطلاعات سفارش</h3>
                    <div class="space-y-6 text-lg">
                        <div class="flex justify-between">
                            <span class="text-gray-600">تاریخ ثبت:</span>
                            <span class="font-bold text-purple-700">{{ $order->created_at->format('d F Y - H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">روش پرداخت:</span>
                            <span class="font-bold text-emerald-600">پرداخت آنلاین</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">وضعیت پرداخت:</span>
                            <span class="font-bold text-emerald-600 text-xl">پرداخت شده</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">کد پیگیری:</span>
                            <span class="font-mono font-bold text-purple-700">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                </div>

                <!-- کارت پشتیبانی خفن -->
                <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl shadow-2xl p-10 text-white text-center" data-aos="zoom-in">
                    <svg class="w-20 h-20 mx-auto mb-6 opacity-90" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10 10 0 01-10 10H6a2 2 0 01-2-2V5z"/>
                        <path d="M4 7l2 2 8-8"/>
                    </svg>
                    <h3 class="text-3xl font-black mb- mb-4">نیاز به کمک داری؟</h3>
                    <p class="text-lg opacity-90 mb-8">تیم پشتیبانی لینک‌سا ۲۴ ساعته در خدمته</p>
                    <a href="mailto:support@linksa.ir"
                       class="inline-block bg-white text-purple-600 font-black text-xl px-12 py-6 rounded-2xl hover:bg-gray-100 transform hover:scale-110 transition-all duration-300 shadow-xl">
                        تماس با پشتیبانی
                    </a>
                </div>
            </div>
        </div>

        <!-- دکمه بازگشت -->
        <div class="text-center mt-20">
            <a href="{{ route('orders.index') }}"
               class="inline-block bg-gradient-to-r from-gray-700 to-black hover:from-black hover:to-gray-900 text-white font-black text-2xl px-16 py-7 rounded-3xl shadow-2xl hover:shadow-gray-900/50 transform hover:scale-105 transition-all duration-300">
                بازگشت به لیست سفارش‌ها
            </a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true });
</script>
@endsection