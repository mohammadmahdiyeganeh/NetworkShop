<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8">

            <!-- عنوان -->
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                    بازنشانی رمز عبور 🔐
                </h1>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                    رمز عبورت را فراموش کرده‌ای؟ مشکلی نیست 😊<br>
                    فقط ایمیلت را وارد کن تا لینک بازنشانی برایت ارسال شود.
                </p>
            </div>

            <!-- وضعیت سشن -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- ایمیل -->
                <div>
                    <x-input-label for="email" :value="__('ایمیل')" />
                    <x-text-input id="email" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus
                        class="block mt-1 w-full border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- دکمه ارسال -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold">
                        ارسال لینک بازنشانی رمز عبور
                    </button>
                </div>

                <!-- لینک بازگشت -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    به یاد آوردی؟
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                        بازگشت به ورود
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
