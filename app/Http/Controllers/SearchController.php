<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = Product::where('name', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->paginate(12);

        return view('search.results', compact('products', 'query'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('q');
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id','name','price','image']);

        return response()->json($products);
    }
}