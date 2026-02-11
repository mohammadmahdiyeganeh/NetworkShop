<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderController extends Controller
{
    /**
     * نمایش لیست سفارشات کاربر
     */
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->with('products') // رابطه products رو لود می‌کنه (حتی حذف‌شده‌ها رو!)
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * نمایش جزئیات یک سفارش
     */
    public function show($id)
    {
        $order = Auth::user()
            ->orders()
            ->with('products') // همین کافیه — چون رابطه درست تعریف شده
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}