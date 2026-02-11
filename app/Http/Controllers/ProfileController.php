<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated')
            ->with('success', 'اطلاعات با موفقیت بروزرسانی شد.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'حساب شما با موفقیت حذف شد.');
    }

    /**
     * داشبورد کاربر — ۱۰۰٪ بدون خطا، حتی اگه رابطه products خراب باشه
     */
   public function dashboard(): View
{
    $user = Auth::user();

    // سفارشات رو می‌گیریم
    $orders = \App\Models\Order::where('user_id', $user->id)
        ->latest()
        ->get();

    // برای هر سفارش، محصولات رو دستی از دیتابیس می‌کشیم (بدون withTrashed و بدون رابطه)
    foreach ($orders as $order) {
        $products = \App\Models\Product::join('order_product', 'products.id', '=', 'order_product.product_id')
            ->where('order_product.order_id', $order->id)
            ->select('products.*', 'order_product.quantity as pivot_quantity', 'order_product.price as pivot_price', 'order_product.image as pivot_image')
            ->get();

        // محصولات رو دستی به سفارش وصل می‌کنیم
        $order->setRelation('products', $products);
    }

    // سفارشات رو به کاربر وصل می‌کنیم
    $user->setRelation('orders', $orders);

    return view('dashboard', compact('user'));
}
}