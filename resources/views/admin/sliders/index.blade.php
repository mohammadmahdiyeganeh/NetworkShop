@extends('layouts.app')
@section('title', 'مدیریت اسلایدر | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-16 px-4">
    <div class="max-w-6xl mx-auto">

        <div class="text-center mb-16">
            <h1 class="text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600">
                مدیریت اسلایدر
            </h1>
            <p class="text-3xl font-bold text-gray-700 mt-8">عکس‌های صفحه اصلی رو اینجا تغییر بده</p>
        </div>

        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-gradient-to-r from-emerald-500 to-teal-600 text-white p-6 rounded-3xl shadow-2xl text-center mb-10">
                <p class="text-2xl font-black">{{ session('success') }}</p>
            </div>
        @endif

        <!-- فرم آپلود -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 mb-12">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-2xl font-black mb-4">عکس اسلایدر</label>
                        <input type="file" name="image" required class="w-full text-lg">
                    </div>
                    <div>
                        <label class="block text-2xl font-black mb-4">عنوان (اختیاری)</label>
                        <input type="text" name="title" class="w-full px-6 py-4 rounded-2xl border-2 border-purple-200">
                    </div>
                    <div>
                        <label class="block text-2xl font-black mb-4">زیرعنوان (اختیاری)</label>
                        <input type="text" name="subtitle" class="w-full px-6 py-4 rounded-2xl border-2 border-purple-200">
                    </div>
                </div>
                <button type="submit"
                        class="mt-8 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-2xl px-16 py-6 rounded-3xl shadow-2xl transform hover:scale-105 transition">
                    افزودن اسلایدر
                </button>
            </form>
        </div>

        <!-- لیست اسلایدرها با Drag & Drop -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="sliders-container">
            @foreach($sliders as $slider)
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden cursor-move" data-id="{{ $slider->id }}">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-black">{{ $slider->title ?? 'بدون عنوان' }}</h3>
                        <p class="text-gray-600">{{ $slider->subtitle ?? '' }}</p>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="mt-4 inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('مطمئ حذف بشه؟')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl font-bold">
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ route('admin.dashboard') }}" class="text-3xl font-black text-purple-600 hover:text-pink-600">
                بازگشت به داشبورد
            </a>
        </div>
    </div>
</div>

<!-- Drag & Drop با Sortable.js -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    new Sortable(document.getElementById('sliders-container'), {
        animation: 150,
        ghostClass: 'bg-purple-100',
        onEnd: function () {
            let order = [];
            document.querySelectorAll('#sliders-container > div').forEach((el, index) => {
                order.push(el.dataset.id);
            });

            fetch("{{ route('admin.sliders.order') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ order: order })
            });
        }
    });
</script>
@endsection