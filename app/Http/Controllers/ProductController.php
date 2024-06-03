<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Ürünler Listesi
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // Yeni Ürün Ekleme
    public function create()
    {
        $categories = Category::all();
        return view('products.form', compact('categories'));
    }

    // Yeni Ürün Ekleme
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product = new Product([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        
        if ($request->hasFile('image')) {
            $uploadPath = public_path('/images/products/');
    
            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadPath, $fileName);
    
            $fileUrl = '/images/products/' . $fileName;
    
            $product->image = $fileUrl;
        }
    
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // Ürün Düzenleme
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.form', compact('product', 'categories'));
    }

    // ürün Güncelleme
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = public_path('/images/products/');
    
            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadPath, $fileName);
    
            $fileUrl = '/images/products/' . $fileName;
    
            $product->image = $fileUrl;
        }
    
        $product->update();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Ürün Silme
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
