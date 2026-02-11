<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * نمایش لیست تمام کامنت‌ها (تأیید شده و در انتظار)
     */
    public function index()
    {
        $comments = Comment::with(['user', 'product'])
            ->latest()
            ->paginate(25);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * تأیید کردن کامنت
     */
    public function approve(Comment $comment)
    {
        $comment->update(['approved' => true]);

        // کش کامنت‌های محصول رو پاک کن تا فوراً نمایش داده بشه
        cache()->forget('product_comments_' . $comment->product_id);

        return back()->with('success', 'کامنت با موفقیت تأیید شد و حالا در سایت نمایش داده می‌شه ✅');
    }

    /**
     * رد کردن و حذف کامنت
     */
    public function reject(Comment $comment)
    {
        $comment->delete();

        // کش محصول رو هم پاک کن (اختیاری ولی خوبه)
        cache()->forget('product_comments_' . $comment->product_id);

        return back()->with('success', 'کامنت با موفقیت حذف شد ❌');
    }

    /**
     * نمایش جزئیات یک کامنت (اختیاری)
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'product', 'replies.user']);
        return view('admin.comments.show', compact('comment'));
    }
}