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
            'title'       => ['required', 'string', 'max:200'],
            'category'    => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['required', 'string', 'min:20'],
            'price'       => ['required', 'numeric', 'min:0'],
            'image_path'  => ['required', 'array'], // Validamos que sea un arreglo
            'image_path.*' => ['image', 'max:5120'], // Validamos cada imagen dentro
        ]);

        $path = null;
        if ($request->hasFile('image_path')) {
            $files = $request->file('image_path');
            if (isset($files[0])) {
                // Guardamos la primera imagen en el disco público
                $path = $files[0]->store('products', 'public');
            }
        }

        Product::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'location'    => $request->location,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $path,
            'is_active'   => true,
        ]);

        return redirect()->route('seller.products.create')
            ->with('success', '¡Producto publicado correctamente!');
    }

    public function dashboard()
    {
        $products = Product::where('user_id', auth()->id())->get();
        return view('seller.dashboard', compact('products'));
    }
}
