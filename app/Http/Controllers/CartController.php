<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $cart_total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('cart.index', compact('cart', 'cart_total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'محصول یافت نشد.'
            ], 404);
        }

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        $cart_total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        return response()->json([
            'success' => true,
            'count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $cart_total
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        $id = $request->id;
        $qty = $request->quantity;

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'محصول در سبد نیست'], 404);
        }

        $cart[$id]['quantity'] = $qty;
        session(['cart' => $cart]);

        $item_total = $cart[$id]['price'] * $qty;
        $cart_total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        return response()->json([
            'success' => true,
            'item_total' => $item_total,
            'cart_total' => $cart_total,
            'count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cart = session('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'محصول یافت نشد'], 404);
        }

        unset($cart[$id]);
        session(['cart' => $cart]);

        $cart_total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cart_total' => $cart_total,
            'count' => $count
        ]);
    }
}