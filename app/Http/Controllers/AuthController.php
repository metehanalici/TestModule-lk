<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;

class AuthController extends Controller
{
    public function showForm()
    {
        $categories = Category::all();
        $productsByCategory = [];

        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $productsByCategory[$category->name] = $products;
        }

        return view('auth.register-login', compact('categories', 'productsByCategory'));
    }

    // Kayıt
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/show-register-login-form')->with('success', 'Başarıyla kayıt oldunuz!');
    }

    // Giriş
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Admin başarıyla giriş yaptı');
            } else {
                return redirect()->route('dashboard')->with('success', 'Kullanıcı başarıyla giriş yaptı');
            }
        }

        return redirect()->route('login')->with('error', 'Geçersiz kimlik bilgileri');
    }

    // Kullanıcı Sayfası
    public function Dashboard()
    {
        $categories = Category::all();
        $productsByCategory = [];
        $cartCount = 0;
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $productsByCategory[$category->name] = $products;
        }
        return view('dashboard' , compact('categories', 'productsByCategory' , 'cartCount'));
    }

    // Admin Sayfası
    public function Admindashboard()
    {
        return view('admin.dashboard');
    }

    // Çıkış
    public function logout()
    {
        Auth::logout();

        return redirect('/show-register-login-form')->with('success', 'Logged out successfully');
    }

}
