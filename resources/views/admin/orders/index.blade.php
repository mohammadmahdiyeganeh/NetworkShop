@extends('layouts.app')
@section('title', 'مدیریت سفارش‌ها | ادمین | LINKSA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">

        <!-- جدول سفارش‌ها -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white">
                            <th class="px-6 py-4">شماره سفارش</th>
                            <th class="px-6 py-4">مشتری</th>
                            <th class="px-6 py-4">مبلغ کل</th>
                            <th class="px-6 py-4">تاریخ</th>
                            <th class="px-6 py-4">تغییر وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-6 py-4 text-center">#{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->user->name }}<br>{{ $order->user->email }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($order->total) }} تومان</td>
                                <td class="px-6 py-4 text-center">{{ $order->created_at->format('d F Y H:i') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form class="order-status-form" data-id="{{ $order->id }}" data-action="{{ route('admin.orders.updateStatus', $order) }}">
                                        @csrf @method('PATCH')
                                        <select name="status_id" class="status-select border rounded-xl px-4 py-2">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">هیچ سفارشی ثبت نشده</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- صفحه‌بندی -->
            <div class="p-6 bg-purple-50">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

<!-- اسکریپت AJAX -->
<script>
document.querySelectorAll('.status-select').forEach(select => {
  select.addEventListener('change', async function() {
    const form = this.closest('.order-status-form');
    const action = form.dataset.action;
    const statusId = this.value;

    try {
      const res = await fetch(action, {
        method: 'PATCH',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status_id: statusId })
      });

      const text = await res.text();
      try {
        const data = JSON.parse(text);
        if (data.success) {
          // فقط در کنسول لاگ می‌کنیم
          console.log('OK', data);
        } else {
          console.error('Server returned error', data);
        }
      } catch (e) {
        console.error('Response is not JSON:', text);
      }
    } catch (err) {
      console.error('Fetch error', err);
    }
  });
});
</script>
@endsection