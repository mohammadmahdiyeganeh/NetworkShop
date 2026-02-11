<section class="space-y-8" data-aos="fade-up">
    <header>
        <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-pink-600 drop-shadow-lg">
            حذف حساب کاربری
        </h2>
        <p class="mt-4 text-lg text-gray-600 leading-relaxed">
            با حذف حساب، تمام اطلاعات، سفارشات، کامنت‌ها و داده‌های شما <span class="text-red-600 font-bold">برای همیشه</span> پاک می‌شوند.
            <br>قبل از حذف، اگر اطلاعات مهمی دارید، حتماً دانلود یا بکاپ بگیرید.
        </p>
    </header>

    <!-- دکمه اصلی حذف — خفن و ترسناک (به عمد!) -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="group relative inline-flex items-center gap-4 bg-gradient-to-r from-red-600 to-pink-700 text-white font-black text-xl px-10 py-5 rounded-2xl shadow-2xl hover:shadow-red-500/50 transform hover:scale-105 transition-all duration-300 overflow-hidden">
        <span class="relative z-10">حذف دائمی حساب کاربری</span>
        <svg class="w-8 h-8 relative z-10 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <!-- افکت موج قرمز -->
        <div class="absolute inset-0 bg-white/20 transform translate-x-[-100%] group-hover:translate-x-full transition-transform duration-1000"></div>
    </button>

    <!-- مودال تأیید حذف — کاملاً بازطراحی شده -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-8 bg-gradient-to-br from-red-50 via-pink-50 to-purple-50 rounded-3xl shadow-2xl max-w-lg mx-auto">
            <div class="text-center mb-8">
                <div class="w-24 h-24 mx-auto bg-red-100 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-16 h-16 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.742-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-gray-800 mt-6">
                    واقعاً می‌خوای حسابتو حذف کنی؟
                </h2>
                <p class="text-lg text-gray-600 mt-4">
                    این عمل <span class="text-red-600 font-bold">غیرقابل بازگشت</span> است.<br>
                    همه چیز برای همیشه پاک میشه!
                </p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <!-- فیلد رمز عبور -->
                <div>
                    <x-input-label for="password" value="رمز عبور فعلی" class="text-lg font-bold text-gray-800" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-3 block w-full rounded-2xl border-2 border-red-200 focus:border-red-500 focus:ring-4 focus:ring-red-100 text-lg py-4 px-6"
                        placeholder="برای تأیید، رمز عبور رو وارد کن..."
                        required
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-3 text-red-600 font-bold" />
                </div>

                <!-- دکمه‌ها -->
                <div class="flex justify-center gap-6 mt-10">
                    <x-secondary-button
                        x-on:click="$dispatch('close')"
                        class="px-10 py-4 text-lg font-black rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                        نه، برگردم عقب!
                    </x-secondary-button>

                    <x-danger-button
                        class="px-12 py-5 text-lg font-black rounded-2xl shadow-2xl hover:shadow-red-600/50 transform hover:scale-110 transition bg-gradient-to-r from-red-600 to-pink-700">
                        بله، حسابمو حذف کن
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>