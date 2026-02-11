<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * صفحه اصلی (لندینگ) — فقط ۶ محصول جدید
     */
    public function index()
    {
        $products = Product::latest()->take(6)->get();
        $sort = 'newest'; // برای صفحه اصلی همیشه جدیدترین

        return view('products.index', compact('products', 'sort'));
    }

    /**
     * لیست کامل محصولات + فیلتر (جدیدترین، پرفروش‌ترین و ...)
     */
    public function products(Request $request)
    {
        $sort = $request->query('sort', 'newest');

        $query = Product::query();

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