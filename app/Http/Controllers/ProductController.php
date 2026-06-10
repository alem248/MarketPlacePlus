<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('seller.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $product = new Product();
        $product->user_id = auth()->id();
        $product->title = $request->title;
        $product->category = $request->category;
        $product->location = $request->location;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products', 'public');
        }

        $product->is_active = true;
        $product->save();

        return redirect()->back()->with('success', '¡Publicación creada exitosamente!');
    }

    public function dashboard()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return view('seller.dashboard', compact('products'));
    }
}
