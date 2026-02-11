<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8">
            
            <!-- لوگو و عنوان -->
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                    ثبت‌نام در <span class="text-indigo-700">LINKSA</span>
                </h1>
                <p class="mt-2 text-gray-500 text-sm">ساخت حساب جدید در فروشگاه لینکسا</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- نام -->
                <div>
                    <x-input-label for="name" :value="__('نام کامل')" />
                    <x-text-input id="name" type="text" name="name"
                        :value="old('name')" required autofocus
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- ایمیل -->
                <div>
                    <x-input-label for="email" :value="__('ایمیل')" />
                    <x-text-input id="email" type="email" name="email"
                        :value="old('email')" required autocomplete="username"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- رمز عبور -->
                <div>
                    <x-input-label for="password" :value="__('رمز عبور')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- تأیید رمز -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('تأیید رمز عبور')" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- دکمه ثبت -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold">
                        ثبت‌نام
                    </button>
                </div>

                <!-- لینک ورود -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    قبلاً ثبت‌نام کرده‌اید؟
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        وارد شوید
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
