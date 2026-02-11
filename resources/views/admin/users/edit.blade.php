@extends('layouts.app')
@section('title', 'ویرایش کاربر | ادمین')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 flex items-center justify-center py-16 px-4">
    <div class="w-full max-w-2xl bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 p-12">
        <h1 class="text-7xl font-black text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-12">
            ویرایش {{ $user->name }}
        </h1>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PATCH')

            <div class="space-y-10">
                <div>
                    <label class="block text-3xl font-black text-gray-800 mb-4">نام</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-10 py-8 text-2xl text-center rounded-3xl border-4 border-purple-200 focus:border-purple-600 focus:ring-8 focus:ring-purple-100 shadow-2xl">
                </div>

                <div>
                    <label class="block text-3xl font-black text-gray-800 mb-4">ایمیل</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-10 py-8 text-2xl text-center rounded-3xl border-4 border-purple-200 focus:border-purple-600 focus:ring-8 focus:ring-purple-100 shadow-2xl">
                </div>

                <div class="text-center">
                    <label class="flex items-center justify-center gap-6 text-3xl font-black text-gray-800 cursor-pointer">
                        <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}
                               class="w-12 h-12 rounded-2xl text-purple-600 focus:ring-purple-500">
                        <span>این کاربر ادمین باشه؟</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-center gap-10 mt-16">
                <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-3xl px-20 py-10 rounded-3xl shadow-2xl transform hover:scale-110 transition">
                    ذخیره تغییرات
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-black text-3xl px-20 py-10 rounded-3xl shadow-2xl transform hover:scale-110 transition">
                    انصراف
                </a>
            </div>
        </form>
    </div>
</div>
@endsection