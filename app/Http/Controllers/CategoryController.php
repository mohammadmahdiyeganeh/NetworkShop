<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->paginate(12);
        return view('categories.show', compact('category', 'products'));
    }
}