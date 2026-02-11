<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8 space-y-6">

            <!-- عنوان -->
            <div class="text-center">
                <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                    بازنشانی رمز عبور 🔐
                </h1>
                <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                    رمز جدید خود را وارد کنید و حساب LINKSA خود را بازیابی کنید.
                </p>
            </div>

            <!-- فرم -->
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- ایمیل -->
                <div>
                    <x-input-label for="email" :value="__('ایمیل')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- رمز جدید -->
                <div>
                    <x-input-label for="password" :value="__('رمز عبور جدید')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- تأیید رمز -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('تأیید رمز عبور')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- دکمه -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold">
                        بازنشانی رمز عبور
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600 mt-4">
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        بازگشت به ورود
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
