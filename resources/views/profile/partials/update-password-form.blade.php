<section class="space-y-10" data-aos="fade-up" data-aos-duration="800">
    <header>
        <h2 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-lg">
            تغییر رمز عبور
        </h2>
        <p class="mt-4 text-lg text-gray-600 leading-relaxed max-w-2xl">
            برای امنیت بیشتر، از رمز عبور طولانی و پیچیده (حداقل ۱۲ کاراکتر) استفاده کن.
            <br>ترکیب حروف بزرگ، کوچک، عدد و علامت بهترین انتخابه
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-10 max-w-2xl space-y-8">
        @csrf
        @method('put')

        <!-- رمز عبور فعلی -->
        <div class="group">
            <x-input-label for="update_password_current_password" 
                           value="رمز عبور فعلی" 
                           class="text-lg font-bold text-gray-800 group-focus-within:text-purple-600 transition" />
            <div class="mt-3 relative">
                <x-text-input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="block w-full rounded-2xl border-2 border-purple-200 py-4 px-6 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-shadow duration-300 shadow-md focus:shadow-xl"
                    autocomplete="current-password"
                    placeholder="رمز عبور فعلی رو وارد کن..."
                    required />
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-3 text-red-600 font-bold" />
        </div>

        <!-- رمز عبور جدید -->
        <div class="group">
            <x-input-label for="update_password_password" 
                           value="رمز عبور جدید" 
                           class="text-lg font-bold text-gray-800 group-focus-within:text-purple-600 transition" />
            <div class="mt-3 relative">
                <x-text-input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="block w-full rounded-2xl border-2 border-purple-200 py-4 px-6 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-shadow duration-300 shadow-md focus:shadow-xl"
                    autocomplete="new-password"
                    placeholder="رمز عبور جدید (حداقل ۱۲ کاراکتر)"
                    required />
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-3 text-red-600 font-bold" />
        </div>

        <!-- تأیید رمز عبور -->
        <div class="group">
            <x-input-label for="update_password_password_confirmation" 
                           value="تکرار رمز عبور جدید" 
                           class="text-lg font-bold text-gray-800 group-focus-within:text-purple-600 transition" />
            <div class="mt-3 relative">
                <x-text-input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="block w-full rounded-2xl border-2 border-purple-200 py-4 px-6 text-lg focus:border-purple-600 focus:ring-4 focus:ring-purple-100 transition-shadow duration-300 shadow-md focus:shadow-xl"
                    autocomplete="new-password"
                    placeholder="رمز عبور جدید رو دوباره وارد کن"
                    required />
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- دکمه‌ها و پیام موفقیت -->
        <div class="flex items-center gap-6 pt-6">
            <x-primary-button class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl px-12 py-5 rounded-2xl shadow-2xl hover:shadow-pink-500/50 transform hover:scale-105 transition-all duration-300">
                ذخیره رمز عبور جدید
            </x-primary-button>

            <!-- پیام موفقیت با انیمیشن -->
            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-end="opacity-0 transform scale-90"
                     x-init="setTimeout(() => show = false, 4000)"
                     class="bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black px-8 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-pulse">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    رمز عبور با موفقیت تغییر کرد!
                </div>
            @endif
        </div>
    </form>
</section>