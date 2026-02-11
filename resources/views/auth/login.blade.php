<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8">
            
            <!-- لوگو -->
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                    ورود به <span class="text-indigo-700">LINKSA</span>
                </h1>
                <p class="mt-2 text-gray-500 text-sm">به حساب کاربری خود وارد شوید</p>
            </div>

            <!-- وضعیت سشن -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <!-- ایمیل -->
                <div>
                    <x-input-label for="email" :value="__('ایمیل')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- رمز عبور -->
                <div>
                    <x-input-label for="password" :value="__('رمز عبور')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- مرا به خاطر بسپار -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                        <span class="mr-2">مرا به خاطر بسپار</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            رمز عبور را فراموش کرده‌اید؟
                        </a>
                    @endif
                </div>

                <!-- دکمه ورود -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold">
                        ورود
                    </button>
                </div>

                <!-- ثبت‌نام -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    حساب ندارید؟
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        ثبت‌نام کنید
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
