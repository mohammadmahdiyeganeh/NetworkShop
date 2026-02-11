<section class="space-y-10" data-aos="fade-up" data-aos-duration="900">
    <header>
        <h2 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-2xl">
            اطلاعات حساب کاربری
        </h2>
        <p class="mt-5 text-xl text-gray-600 leading-relaxed max-w-3xl">
            اینجا می‌تونی اسم و ایمیلت رو تغییر بدی.  
            اگه ایمیل جدید وارد کنی، باید دوباره تأییدش کنی.
        </p>
    </header>

    <!-- فرم ارسال مجدد ایمیل تأیید (مخفی) -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-12 max-w-2xl space-y-10">
        @csrf
        @method('patch')

        <!-- نام و نام خانوادگی -->
        <div class="group">
            <x-input-label for="name" value="نام و نام خانوادگی" 
                           class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition" />
            <div class="mt-4 relative">
                <x-text-input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="block w-full rounded-2xl border-2 border-purple-200 py-5 px-16 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                    :value="old('name', $user->name)" 
                    required 
                    autofocus 
                    autocomplete="name"
                    placeholder="مثلاً: علی رضایی" />
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-3 text-red-600 font-bold" />
        </div>

        <!-- ایمیل -->
        <div class="group">
            <x-input-label for="email" value="آدرس ایمیل" 
                           class="text-xl font-bold text-gray-800 group-focus-within:text-purple-600 transition" />
            <div class="mt-4 relative">
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full rounded-2xl border-2 border-purple-200 py-5 px-16 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-all duration-300 shadow-lg focus:shadow-2xl"
                    :value="old('email', $user->email)" 
                    required 
                    autocomplete="username"
                    placeholder="مثلاً: ali@example.com" />
                <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-3 text-red-600 font-bold" />

            <!-- وضعیت تأیید ایمیل -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-6 p-6 bg-yellow-50 border-2 border-yellow-300 rounded-2xl">
                    <p class="text-lg font-bold text-yellow-800">
                        ایمیل شما هنوز تأیید نشده!
                    </p>
                    <button form="send-verification" 
                            class="mt-4 inline-block bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-black px-8 py-4 rounded-2xl shadow-xl hover:shadow-orange-500/50 transform hover:scale-105 transition">
                        ارسال مجدد لینک تأیید
                    </button>
                </div>
            @endif

            @if (session('status') === 'verification-link-sent')
                <div class="mt-6 p-6 bg-green-50 border-2 border-green-300 rounded-2xl text-center">
                    <p class="text-xl font-black text-green-700">
                        لینک تأیید جدید به ایمیلت فرستاده شد!
                    </p>
                </div>
            @endif
        </div>

        <!-- دکمه ذخیره + پیام موفقیت -->
        <div class="flex items-center gap-8 pt-8">
            <x-primary-button class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-14 py-6 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-110 transition-all duration-300">
                ذخیره تغییرات
            </x-primary-button>

            <!-- پیام موفقیت خفن -->
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 transform translate-y-10 scale-50"
                     x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                     x-init="setTimeout(() => show = false, 5000)"
                     class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black text-xl px-10 py-6 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    اطلاعات با موفقیت ذخیره شد!
                </div>
            @endif
        </div>
    </form>
</section>