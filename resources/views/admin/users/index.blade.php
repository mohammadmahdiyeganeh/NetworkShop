@extends('layouts.app')
@section('title', 'مدیریت کاربران | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-4">
    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-16">
            <h1 class="text-8xl md:text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 drop-shadow-3xl">
                کاربران LINKSA
            </h1>
            <p class="text-4xl font-bold text-gray-700 mt-8">اینجا همه قهرمان‌های ما هستن</p>
        </div>

        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-10 py-8 rounded-3xl shadow-2xl text-center mb-12">
                <p class="text-3xl font-black">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-rose-500 to-red-600 text-white px-10 py-8 rounded-3xl shadow-2xl text-center mb-12">
                <p class="text-3xl font-black">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white">
                            <th class="px-10 py-8 text-2xl font-black text-right">نام</th>
                            <th class="px-10 py-8 text-2xl font-black text-right">ایمیل</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">نقش</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">سفارشات</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">تاریخ عضویت</th>
                            <th class="px-10 py-8 text-2xl font-black text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-100">
                        @forelse($users as $u)
                            <tr class="hover:bg-purple-50/70 transition-all duration-300">
                                <td class="px-10 py-8 text-right">
                                    <p class="text-2xl font-black text-gray-800">{{ $u->name }}</p>
                                </td>
                                <td class="px-10 py-8 text-right text-xl text-purple-600">{{ $u->email }}</td>
                                <td class="px-10 py-8 text-center">
                                    <span class="inline-block px-8 py-4 rounded-full text-xl font-black 
                                        {{ $u->is_admin ? 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-4 border-amber-300' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $u->is_admin ? 'ادمین' : 'کاربر' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center text-3xl font-black text-emerald-600">
                                    {{ $u->orders->count() }}
                                </td>
                                <td class="px-10 py-8 text-center text-xl font-medium text-gray-600">
                                    {{ $u->created_at->format('d M Y') }}
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex justify-center gap-6">
                                        <a href="{{ route('admin.users.edit', $u) }}"
                                           class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xl px-10 py-5 rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-110 transition">
                                            ویرایش
                                        </a>
                                        @if(auth()->id() !== $u->id)
                                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('مطمئنی می‌خوای «{{ $u->name }}» رو حذف کنی؟')"
                                                        class="bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-black text-xl px-10 py-5 rounded-3xl shadow-xl hover:shadow-2xl transform hover:scale-110 transition">
                                                    حذف
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-32 text-center">
                                    <p class="text-5xl font-black text-gray-600">هنوز هیچ کاربری ثبت‌نام نکرده</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-8 bg-gradient-to-r from-purple-50 to-pink-50">
                {{ $users->links() }}
            </div>
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('admin.dashboard') }}" class="text-3xl font-black text-purple-600 hover:text-pink-600">
                بازگشت به داشبورد
            </a>
        </div>
    </div>
</div>
@endsection