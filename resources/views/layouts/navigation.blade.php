{{-- resources/views/layouts/navigation.blade.php --}}
<nav class="bg-white/80 backdrop-blur-xl shadow-2xl sticky top-0 z-50 border-b border-purple-100">
    <div class="container mx-auto px-6 py-5 flex justify-between items-center">

        <!-- لوگو با گرادیان متحرک خفن -->
        <a href="{{ route('home') }}" class="group">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-2xl group-hover:scale-110 transition-all duration-500">
                    <span class="text-white font-black text-3xl tracking-tighter">L</span>
                </div>
                <span class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 background-animate">
                    LINKSA
                </span>
            </div>
        </a>

        <!-- همبرگر موبایل -->
        <button id="mobile-menu-button" class="md:hidden text-purple-600 focus:outline-none">
            <svg class="w-8 h-8 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- منوی دسکتاپ -->
        <div class="hidden md:flex items-center gap-10 flex-1 justify-end">

            <!-- سرچ‌بار خفن -->
          <!-- سرچ‌بار با autocomplete -->
<!-- سرچ‌بار با autocomplete -->
<form action="{{ route('search') }}" method="GET" class="relative group">
    <input type="text" id="search-bar" name="q" placeholder="جستجو در محصولات..."
           class="w-80 py-4 px-14 rounded-full border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl text-lg font-medium placeholder-gray-400">
    <button type="submit" class="absolute left-5 top-1/2 -translate-y-1/2 text-purple-600 hover:scale-125 transition">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </button>

    <!-- نتایج autocomplete -->
    <div id="search-results"
         class="absolute top-full mt-2 w-full bg-white shadow-xl rounded-2xl border border-purple-100 hidden z-50"></div>
</form>

<script>
document.getElementById('search-bar').addEventListener('input', function() {
    let q = this.value;
    let results = document.getElementById('search-results');

    if (q.length < 2) {
        results.innerHTML = '';
        results.classList.add('hidden');
        return;
    }

    fetch(`/search/autocomplete?q=${q}`)
        .then(res => res.json())
        .then(data => {
            results.innerHTML = '';
            if (data.length === 0) {
                results.classList.add('hidden');
                return;
            }
            results.classList.remove('hidden');

            data.forEach(product => {
                let div = document.createElement('div');
                div.className = 'flex items-center px-4 py-2 hover:bg-purple-50 cursor-pointer';

                let img = document.createElement('img');
                img.src = product.image;
                img.className = 'w-10 h-10 object-cover rounded mr-3';

                let text = document.createElement('div');
                text.innerHTML = `<strong>${product.name}</strong><br><span class="text-sm text-gray-600">${product.price} تومان</span>`;

                div.appendChild(img);
                div.appendChild(text);

                div.onclick = () => window.location.href = `/products/${product.id}`;
                results.appendChild(div);
            });
        });
});
</script>

            <!-- دسته‌بندی‌ها با دراپ‌داون زیبا -->
            <div class="relative group">
                <button class="flex items-center gap-3 text-xl font-bold text-gray-700 hover:text-purple-600 transition">
                    دسته‌بندی‌ها
                    <svg class="w-6 h-6 group-hover:rotate-180 transition duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="absolute top-full mt-4 right-0 w-64 bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-purple-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-500 transform group-hover:translate-y-2">
                    <div class="py-4">
                        @foreach(\App\Models\Category::all() as $category)
                            <a href="{{ route('categories.show', $category) }}"
                               class="block px-8 py-4 text-lg font-bold hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 transition flex items-center gap-4">
                                <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- آیکون سبد خرید با شمارنده زنده -->
            <a href="{{ route('cart.index') }}" class="relative group">
                <div class="p-4 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 group-hover:from-purple-200 group-hover:to-pink-200 transition-all duration-300 shadow-lg hover:shadow-2xl hover:shadow-purple-300/50 transform hover:scale-110">
                    <svg class="w-8 h-8 text-purple-700 group-hover:text-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 0 0 0-4zm-8 2a2 2 0 11-4 0 2 2 0 0 0 0z"/>
                    </svg>
                    <span id="cart-count"
                          class="absolute -top-2 -left-2 bg-gradient-to-br from-red-500 to-pink-600 text-white text-sm font-black rounded-full w-8 h-8 flex items-center justify-center shadow-xl animate-pulse">
                        {{ count(session('cart', [])) }}
                    </span>
                </div>
            </a>

            <!-- وضعیت کاربر -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">خوش آمدی</p>
                            <p class="font-black text-purple-700 text-lg">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="h-12 w-px bg-purple-200"></div>
                        <a href="{{ route('dashboard') }}"
                           class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black px-8 py-4 rounded-2xl shadow-xl hover:shadow-pink-500/50 transform hover:scale-105 transition">
                            داشبورد
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-black px-8 py-4 rounded-2xl shadow-xl hover:shadow-teal-500/50 transform hover:scale-105 transition">
                                ادمین
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-gradient-to-r from-red-600 to-pink-700 hover:from-red-700 hover:to-pink-800 text-white font-black px-8 py-4 rounded-2xl shadow-xl hover:shadow-red-500/50 transform hover:scale-105 transition">
                                خروج
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex gap-4">
                        <a href="{{ route('login') }}"
                           class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-black px-10 py-4 rounded-2xl shadow-xl hover:shadow-purple-500/50 transform hover:scale-110 transition text-lg">
                            ورود
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 text-white font-black px-10 py-4 rounded-2xl shadow-xl hover:shadow-pink-500/50 transform hover:scale-110 transition text-lg">
                            ثبت‌نام
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- منوی موبایل — شاهکار -->
    <div id="mobile-menu" class="md:hidden bg-white/95 backdrop-blur-xl shadow-2xl border-t border-purple-100 absolute w-full left-0 top-full opacity-0 invisible transition-all duration-500 transform -translate-y-10">
        <div class="py-6 px-8 space-y-6">
            <form action="{{ route('search') }}" method="GET" class="mb-6">
                <input type="text" name="q" placeholder="جستجو در محصولات..."
                       class="w-full py-4 px-6 rounded-2xl border-2 border-purple-200 focus:border-purple-600 focus:ring-4 focus:ring-purple-100 text-lg">
            </form>

            <a href="{{ route('home') }}" class="block text-2xl font-black text-purple-700 py-3">خانه</a>
            <a href="{{ route('products.index') }}" class="block text-xl font-bold text-gray-700 py-3 hover:text-purple-600 transition">محصولات</a>
            <a href="{{ route('cart.index') }}" class="block text-xl font-bold text-gray-700 py-3 hover:text-purple-600 transition flex items-center gap-4">
                سبد خرید
                <span class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-4 py-1 rounded-full text-sm font-black">
                    {{ count(session('cart', [])) }} مورد
                </span>
            </a>

            @auth
                <div class="pt-6 border-t-2 border-purple-200">
                    <p class="text-lg font-bold text-purple-700 mb-4">سلام، {{ auth()->user()->name }}!</p>
                    <a href="{{ route('dashboard') }}" class="block bg-gradient-to-r from-purple-600 to-pink-600 text-white font-black py-4 rounded-2xl text-center mb-3">داشبورد</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full bg-gradient-to-r from-red-600 to-pink-700 text-white font-black py-4 rounded-2xl">خروج از حساب</button>
                    </form>
                </div>
            @else
                <div class="pt-6 border-t-2 border-purple-200 space-y-4">
                    <a href="{{ route('login') }}" class="block bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-black py-5 rounded-2xl text-center text-xl">ورود به حساب</a>
                    <a href="{{ route('register') }}" class="block bg-gradient-to-r from-pink-600 to-rose-600 text-white font-black py-5 rounded-2xl text-center text-xl">ثبت‌نام رایگان</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .background-animate {
        background-size: 200% 200%;
        animation: gradient 6s ease infinite;
    }
</style>

<script>
    // منوی موبایل
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('opacity-0');
        menu.classList.toggle('invisible');
        menu.classList.toggle('translate-y-0');
        menu.classList.toggle('-translate-y-10');
    });

    // بروزرسانی شمارنده سبد خرید
    document.addEventListener('cart-updated', function () {
        const count = document.querySelectorAll('#cart-count');
        count.forEach(el => {
            el.textContent = {{ count(session('cart', [])) }};
            el.classList.add('animate-ping');
            setTimeout(() => el.classList.remove('animate-ping'), 600);
        });
    });
</script>