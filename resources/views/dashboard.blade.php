
@extends('layouts.app')
@section('title', 'داشبورد | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-4 relative overflow-hidden">
    <!-- پس‌زمینه جادویی -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-300/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <!-- سلام عاشقانه -->
        <div class="text-center mb-16">
            <h1 class="text-8xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-3xl">
                سلام {{ $user->name }} عزیز
            </h1>
            <p class="text-4xl font-bold text-gray-700 mt-8">خوش اومدی به خونه‌ی خودت در LINKSA</p>
        </div>

        <!-- کارت پروفایل لوکس -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-12 mb-16">
            <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="flex items-center gap-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-purple-600 via-pink-600 to-indigo-600 rounded-full flex items-center justify-center text-white text-6xl font-black shadow-2xl">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h2 class="text-5xl font-black text-gray-800">{{ $user->name }}</h2>
                        <p class="text-2xl text-purple-600 font-medium">{{ $user->email }}</p>
                        @if($user->phone)
                            <p class="text-xl text-gray-600 mt-2">تلفن: {{ $user->phone }}</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                   class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-12 py-8 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-500">
                    ویرایش پروفایل
                </a>
            </div>
        </div>

        <!-- آمار طلایی -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
            <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-10 text-center transform hover:scale-105 transition-all duration-500">
                <svg class="w-20 h-20 mx-auto text-purple-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <p class="text-6xl font-black text-purple-700">{{ $user->orders->count() }}</p>
                <p class="text-2xl font-bold text-gray-700 mt-4">سفارش ثبت‌شده</p>
            </div>

            <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-10 text-center transform hover:scale-105 transition-all duration-500">
                <svg class="w-20 h-20 mx-auto text-emerald-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-6xl font-black text-emerald-700">
                    {{ number_format($user->orders->sum('total')) }}
                    <span class="text-4xl">تومان</span>
                </p>
                <p class="text-2xl font-bold text-gray-700 mt-4">کل خرید</p>
            </div>

            <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-10 text-center transform hover:scale-105 transition-all duration-500">
                <svg class="w-20 h-20 mx-auto text-pink-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-4xl font-black text-pink-700">
                    {{ $user->orders->first()?->created_at->format('d F Y') ?? 'هنوز سفارشی نداری' }}
                </p>
                <p class="text-2xl font-bold text-gray-700 mt-4">آخرین سفارش</p>
            </div>
        </div>

        <!-- آخرین سفارشات -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-12">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-5xl font-black text-gray-800">آخرین سفارشات تو</h2>
                <a href="{{ route('orders.index') }}"
                   class="text-2xl font-bold text-purple-600 hover:text-pink-600 transition underline underline-offset-8">
                    همه سفارشات
                </a>
            </div>

            @if($user->orders->count())
                <div class="space-y-8">
                    @foreach($user->orders->take(5) as $order)
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-3xl p-8 hover:shadow-2xl transition-all duration-500 transform hover:scale-[1.02]">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                                <div class="flex items-center gap-8">
                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-xl">
                                        #{{ $order->id }}
                                    </div>
                                    <div>
                                        <p class="text-3xl font-black text-gray-800">
                                            {{ $order->created_at->format('d F Y - H:i') }}
                                        </p>
                                        <p class="text-xl text-gray-600 mt-2">
                                            {{ $order->products->count() }} محصول
                                        </p>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <p class="text-5xl font-black text-emerald-600">
                                        {{ number_format($order->total) }} تومان
                                    </p>

                                    <!-- این قسمت اصلاح شد — همیشه آپدیت هست! -->
                                    @php
                                        $currentStatus = \App\Models\OrderStatus::find($order->status_id);
                                    @endphp
                                    <span class="inline-block px-10 py-4 rounded-full text-2xl font-black mt-6
                                        @switch($currentStatus?->color ?? 'gray')
                                            @case('green')   bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-800 border-4 border-emerald-300 @break
                                            @case('orange')  bg-gradient-to-r from-orange-100 to-amber-100 text-orange-800 border-4 border-orange-300 @break
                                            @case('blue')    bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border-4 border-blue-300 @break
                                            @case('purple')  bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border-4 border-purple-300 @break
                                            @case('red')     bg-gradient-to-r from-rose-100 to-red-100 text-rose-800 border-4 border-rose-300 @break
                                            @default         bg-gray-100 text-gray-600 border-4 border-gray-300
                                        @endswitch">
                                        {{ $currentStatus?->name ?? 'نامشخص' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-40 h-40 mx-auto text-purple-300 mb-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-6xl font-black text-gray-600 mb-8">هنوز سفارشی ثبت نکردی!</p>
                    <p class="text-3xl text-gray-500 mb-12">بیا اولین خریدت رو تجربه کن</p>
                    <a href="{{ route('products.index') }}"
                       class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-4xl px-20 py-12 rounded-3xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-700">
                        برو به فروشگاه
                    </a>
                </div>
            @endif
        </div>

        <!-- پیام پایانی -->
        <div class="text-center mt-24">
            <p class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600">
                LINKSA — جایی که هر خرید، یه عشقه
            </p>
        </div>
    </div>
</div>
@endsection