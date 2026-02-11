<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * نمایش جزئیات محصول + کامنت‌های تأیید شده + محصولات مرتبط
     */
    public function show($id)
    {
        $product = Product::with([
            'comments' => function ($query) {
                $query->whereNull('parent_id')
                      ->where('approved', true)  // فقط کامنت‌های تأیید شده
                      ->with([
                          'user',
                          'likes',
                          'dislikes',
                          'userLike',
                          'replies' => function ($q) {
                              $q->where('approved', true)  // جواب‌ها هم تأیید شده باشن
                                ->with([
                                    'user',
                                    'likes',
                                    'dislikes',
                                    'userLike',
                                    'replies' => function ($qq) {
                                        $qq->with(['user', 'likes', 'dislikes', 'userLike'])
                                           ->latest();
                                    }
                                ])->latest();
                          }
                      ])
                      ->withCount(['likes', 'dislikes'])
                      ->latest();
            }
        ])->findOrFail($id);

        // محصولات مرتبط
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->orderByDesc('sold_count')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        // محصولات پرفروش
        $bestSellers = Product::where('stock', '>', 0)
            ->orderByDesc('sold_count')
            ->take(5)
            ->get();

        return view('products.show', compact(
            'product',
            'relatedProducts',
            'bestSellers'
        ));
    }

    /**
     * لیست محصولات با فیلتر
     */
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'newest');
        $query = Product::query()->where('stock', '>', 0);

        switch ($sort) {
            case 'best_selling':
                $query->orderByDesc('sold_count');
                break;
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'price_high':
                $query->orderByDesc('price');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'newest':
            default:
                $query->orderByDesc('created_at');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'sort'));
    }
}