<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController as UserCommentController; // کامنت کاربر
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController; // کامنت ادمین
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AuthController;

// صفحه اصلی
Route::get('/', [ProductController::class, 'index'])->name('home');

// محصولات
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// دسته‌بندی و جستجو
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');

// کامنت‌های کاربر (نیاز به لاگین)
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/comments', [UserCommentController::class, 'store'])->name('comments.store');
    Route::post('/products/{product}/comments/{comment}/reply', [UserCommentController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment}', [UserCommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/like', [UserCommentController::class, 'like'])->name('comments.like');
    Route::post('/comments/{comment}/dislike', [UserCommentController::class, 'dislike'])->name('comments.dislike');
});

// سبد خرید
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// پرداخت
Route::middleware('auth')->group(function () {
    Route::get('/checkout', function () {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('total'));
    })->name('checkout');

    Route::post('/payment/verify', [App\Http\Controllers\PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/checkout/success', fn() => view('checkout.success'))->name('checkout.success');
});

// داشبورد و پروفایل کاربر
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// پنل ادمین
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // محصولات
        Route::resource('products', AdminProductController::class);

        // دسته‌بندی‌ها
        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        // سفارشات
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // کاربران
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);

        // کامنت‌ها (ادمین)
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::patch('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
        Route::delete('/comments/{comment}/reject', [AdminCommentController::class, 'reject'])->name('comments.reject');

        // اسلایدر
        Route::resource('sliders', SliderController::class)->except(['show']);
        Route::post('sliders/order', [SliderController::class, 'updateOrder'])->name('sliders.order');
    });

// ثبت‌نام با OTP
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->name('verify.email.form');
Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');

// مسیرهای Breeze (login/register/forgot password)
require __DIR__.'/auth.php';