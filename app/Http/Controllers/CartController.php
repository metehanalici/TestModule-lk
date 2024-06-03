<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Product added to cart'], 201);
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart'], 200);
    }

    public function viewCart()
    {
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        return response()->json($cartItems);
    }
}