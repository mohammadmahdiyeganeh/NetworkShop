<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // هر صفحه 10 سفارش
        $orders = Order::with(['user', 'status'])->latest()->paginate(5);
        $statuses = OrderStatus::orderBy('step')->get();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_id' => 'required|exists:order_statuses,id'
        ]);

        $order->update(['status_id' => $request->status_id]);
        $order->unsetRelation('status');
        $order->load('status');

        return response()->json([
            'success' => true,
            'message' => "وضعیت سفارش #{$order->id} به «{$order->status->name}» تغییر کرد",
            'status' => $order->status->name,
            'color' => $order->status->color,
        ]);
    }

    public function show(Order $order)
    {
        $order->load(['user', 'status', 'products']);
        return view('admin.orders.show', compact('order'));
    }
}