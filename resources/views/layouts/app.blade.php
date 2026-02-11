{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LINKSA | فروشگاه آنلاین حرفه‌ای')</title>

    <!-- فونت ایران سنس -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(to bottom, #a855f7, #ec4899); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(to bottom, #9333ea, #db2777); }
    </style>

    <!-- شمارنده اولیه سبد خرید -->
    <script>
        window.initialCartCount = {{ count(session('cart', [])) }};
    </script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 min-h-screen flex flex-col">

    <!-- هدر جدید خفن -->
    @include('layouts.navigation')

    <!-- محتوای اصلی -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- پیام افزودن به سبد — خفن‌تر شده -->
    <div id="add-to-cart-message"
         class="fixed top-24 left-1/2 -translate-x-1/2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-10 py-6 rounded-2xl shadow-2xl z-50 hidden opacity-0 transition-all duration-500 transform scale-75 flex items-center gap-4 font-black text-xl">
        <svg class="w-10 h-10 animate-bounce" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        محصول با موفقیت به سبد اضافه شد!
    </div>

    <!-- فوتر جدید — شاهکار ۲۰۲۵ -->
    <footer class="bg-gradient-to-t from-gray-900 via-purple-900 to-black text-white py-16 mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                <!-- لوگو و درباره ما -->
                <div class="lg:col-span-1">
                    <h2 class="text-5xl font-black bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600 mb-6">
                        LINKSA
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        لینکسا، جایی که کیفیت و زیبایی با هم ملاقات می‌کنن.  
                        بهترین محصولات، سریع‌ترین ارسال، رضایت ۱۰۰٪ تضمینی
                    </p>
                    <div class="flex gap-4 mt-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg"></div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg"></div>
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg"></div>
                    </div>
                </div>

                <!-- لینک‌های سریع -->
                <div>
                    <h3 class="text-2xl font-black mb-8 text-purple-400">لینک‌های سریع</h3>
                    <ul class="space-y-4 text-lg">
                        <li><a href="{{ route('home') }}" class="hover:text-pink-400 transition flex items-center gap-3"><span class="w-2 h-2 bg-pink-500 rounded-full"></span> صفحه اصلی</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-pink-400 transition flex items-center gap-3"><span class="w-2 h-2 bg-pink-500 rounded-full"></span> فروشگاه</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-pink-400 transition flex items-center gap-3"><span class="w-2 h-2 bg-pink-500 rounded-full"></span> سبد خرید</a></li>
                        <li><a href="{{ route('orders.index') }}" class="hover:text-pink-400 transition flex items-center gap-3"><span class="w-2 h-2 bg-pink-500 rounded-full"></span> سفارشات من</a></li>
                    </ul>
                </div>

                <!-- پشتیبانی و تماس -->
                <div>
                    <h3 class="text-2xl font-black mb-8 text-purple-400">پشتیبانی ۲۴ ساعته</h3>
                    <div class="space-y-5 text-lg">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">تلفن پشتیبانی</p>
                                <p class="font-black text-xl">021-2842-5842</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">ایمیل</p>
                                <p class="font-black text-xl">support@linksa.ir</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- شبکه‌های اجتماعی + خبرنامه -->
                <div>
                    <h3 class="text-2xl font-black mb-8 text-purple-400">ما رو دنبال کن</h3>
                    <div class="flex gap-5 mb-10">
                        <a href="#" class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center hover:scale-shadow-2xl hover:scale-125 transition-all duration-300 shadow-xl">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-14 h-14 bg-gradient-to-br from-sky-500 to-cyan-600 rounded-2xl flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-xl">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-xl">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.696.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/></svg>
                        </a>
                    </div>

                    <p class="text-gray-400 mt-10">عضو خبرنامه شو و ۱۰٪ تخفیف بگیر!</p>
                    <form class="mt-4 flex">
                        <input type="email" placeholder="ایمیلتو وارد کن" class="px-6 py-4 rounded-l-2xl w-full text-gray-800 focus:outline-none">
                        <button class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 rounded-r-2xl font-black hover:shadow-pink-500/50 transition">
                            عضویت
                        </button>
                    </form>
                </div>
            </div>

            <!-- کپی‌رایت با افکت -->
            <div class="border-t border-purple-800 mt-16 pt-8 text-center">
                <p class="text-gray-400 text-lg">
                    © {{ now()->year }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 font-black">LINKSA</span> — تمامی حقوق محفوظ است.
                </p>
                
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-out-quart'
        });
    </script>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])
</body>
</html>