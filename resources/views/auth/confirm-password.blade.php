<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8 space-y-6">

            <!-- عنوان و توضیح -->
            <div class="text-center">
                <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                    تأیید رمز عبور 🔒
                </h1>
                <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                    این بخش از برنامه امن است.  
                    لطفاً پیش از ادامه، رمز عبور خود را تأیید کنید.
                </p>
            </div>

            <!-- فرم -->
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="password" :value="__('رمز عبور')" />
                    <x-text-input id="password"
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold">
                        تأیید رمز عبور
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600 mt-4">
                    رمزت را فراموش کردی؟
                    <a href="{{ route('password.request') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        بازیابی رمز عبور
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
