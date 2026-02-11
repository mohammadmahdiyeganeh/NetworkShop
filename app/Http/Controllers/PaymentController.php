<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class PaymentController extends Controller
{
    /**
     * ثبت سفارش بعد از پرداخت موفق (فیک)
     */
    public function verify(Request $request)
    {
        // دریافت سبد خرید
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('error', 'سبد خرید شما خالی است.');
        }

        // محاسبه جمع کل
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // ایجاد سفارش
        $order = Auth::user()->orders()->create([
            'total'     => $total,
            'status_id' => 2, // پرداخت شده
            'items'     => $cart,
        ]);

        // کسر موجودی + افزایش فروش
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if ($product) {
                // چک موجودی (اختیاری)
                if ($product->stock !== null && $product->stock < $item['quantity']) {
                    return redirect()->route('cart.index')
                                     ->with('error', "موجودی محصول {$product->name} کافی نیست.");
                }

                // کسر موجودی
                if ($product->stock !== null) {
                    $product->decrement('stock', $item['quantity']);
                }

                // افزایش تعداد فروش
                $product->increment('sold_count', $item['quantity']);
            }
        }

        // خالی کردن سبد خرید
        session()->forget('cart');

        // مهم: همه اطلاعات لازم رو با سشن بفرست تا تو success.blade.php خطا نده
        return redirect()->route('checkout.success')
                         ->with('success', 'پرداخت با موفقیت انجام شد!')
                         ->with('order_id', $order->id)
                         ->with('order_total', $total); // این خط اضافه شد
    }
}