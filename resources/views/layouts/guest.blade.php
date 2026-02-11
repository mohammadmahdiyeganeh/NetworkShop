{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LINKSA | ورود و ثبت‌نام')</title>

    <!-- فونت وزیری‌متن (بهترین فونت فارسی) -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Vite CSS -->
    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        .bg-guest { background: linear-gradient(135deg, #c084fc 0%, #e9a1ff 30%, #93c5fd 70%, #a78bfa 100%); }
    </style>
</head>
<body class="bg-guest min-h-screen flex flex-col justify-center items-center px-6 py-12 relative overflow-hidden">

    <!-- پس‌زمینه انیمیشنی (دایره‌های شناور) -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-96 h-96 bg-purple-400/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-pink-400/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl animate-pulse delay-2000"></div>
    </div>

    <!-- لوگو + عنوان خفن -->
    <div class="text-center mb-12 z-10" data-aos="fade-down" data-aos-duration="1000">
        <a href="/" class="inline-block transform transition duration-500 hover:scale-110">
            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl flex items-center justify-center shadow-2xl hover:shadow-purple-500/50">
                <span class="text-white font-black text-5xl tracking-tighter">L</span>
            </div>
        </a>
        <h1 class="text-6xl md:text-7xl font-black text-white drop-shadow-2xl mt-8 bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-400">
            LINKSA
        </h1>
        <p class="text-2xl text-white/90 mt-4 font-bold drop-shadow-lg">
            به خانواده لینکسا خوش آمدید
        </p>
    </div>

    <!-- فرم اصلی (ورود/ثبت‌نام) — شاهکار بصری -->
    <div class="w-full max-w-md z-10" data-aos="fade-up" data-aos-delay="300">
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 p-10 transform transition-all duration-500 hover:scale-[1.02] hover:shadow-purple-500/30">
            {{ $slot }}
        </div>
    </div>

    <!-- فوتر شیک -->
    <footer class="mt-16 text-center z-10" data-aos="fade-up" data-aos-delay="600">
        <p class="text-white/80 text-lg font-medium">
            © {{ now()->year }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-pink-300 font-black">
                LINKSA
            </span>
            — تمامی حقوق محفوظ است.
        </p>
        <p class="text-white/60 text-sm mt-3">
            ساخته شده با <span class="text-red-500">♥</span> برای بهترین کاربران ایران
        </p>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000,
            easing: 'ease-out-quart'
        });
    </script>

    <!-- Vite JS -->
    @vite(['resources/js/app.js'])
</body>
</html>