<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    // ثبت کامنت اصلی
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'body' => 'required|string|min:3|max:1000'
        ]);

        $product->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);

        return back()->with('success', 'کامنت شما با موفقیت ثبت شد.');
    }

    // پاسخ به کامنت
    public function reply(Request $request, Product $product, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string|min:3|max:1000'
        ]);

        $product->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'parent_id' => $comment->id
        ]);

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }

    // لایک (فقط یکبار + کلیک دوباره = حذف)
    public function like(Comment $comment)
    {
        $userId = Auth::id();

        $existing = CommentLike::where('comment_id', $comment->id)
                              ->where('user_id', $userId)
                              ->first();

        if ($existing) {
            if ($existing->type === 'like') {
                $existing->delete(); // حذف لایک
            } else {
                $existing->update(['type' => 'like']); // تغییر از دیسلایک به لایک
            }
        } else {
            CommentLike::create([
                'comment_id' => $comment->id,
                'user_id' => $userId,
                'type' => 'like'
            ]);
        }

        return back();
    }

    // دیسلایک (فقط یکبار + کلیک دوباره = حذف)
    public function dislike(Comment $comment)
    {
        $userId = Auth::id();

        $existing = CommentLike::where('comment_id', $comment->id)
                              ->where('user_id', $userId)
                              ->first();

        if ($existing) {
            if ($existing->type === 'dislike') {
                $existing->delete(); // حذف دیسلایک
            } else {
                $existing->update(['type' => 'dislike']); // تغییر از لایک به دیسلایک
            }
        } else {
            CommentLike::create([
                'comment_id' => $comment->id,
                'user_id' => $userId,
                'type' => 'dislike'
            ]);
        }

        return back();
    }

    // حذف کامنت (فقط ادمین)
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'کامنت حذف شد.');
    }
}