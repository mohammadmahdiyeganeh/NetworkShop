<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white/70 backdrop-blur-lg border border-white/40 rounded-2xl shadow-xl p-8 space-y-6 text-center">

            <!-- آیکن یا لوگو -->
            <div class="flex justify-center mb-4">
                <x-application-logo class="w-16 h-16 text-indigo-600" />
            </div>

            <!-- عنوان -->
            <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                تأیید آدرس ایمیل ✉️
            </h1>

            <p class="text-gray-600 text-sm leading-relaxed mt-3">
                ممنون از ثبت‌نام شما! <br>
                لطفاً پیش از شروع، ایمیل خود را از طریق لینکی که برایتان ارسال کردیم تأیید کنید.
                <br>
                اگر ایمیل را دریافت نکردید، می‌توانید دوباره درخواست ارسال دهید.
            </p>

            <!-- وضعیت -->
            @if (session('status') == 'verification-link-sent')
                <div class="bg-emerald-50 text-emerald-700 text-sm font-medium py-2 px-4 rounded-lg border border-emerald-200 shadow-sm">
                    یک لینک تأیید جدید به ایمیل شما ارسال شد ✅
                </div>
            @endif

            <!-- فرم‌ها -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <!-- ارسال مجدد -->
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white px-4 py-2 rounded-lg shadow hover:shadow-lg hover:from-indigo-700 hover:to-blue-600 transition font-semibold text-sm">
                        ارسال مجدد ایمیل تأیید
                    </button>
                </form>

                <!-- خروج -->
                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit"
                        class="w-full underline text-gray-600 hover:text-gray-900 text-sm font-medium transition">
                        خروج
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
