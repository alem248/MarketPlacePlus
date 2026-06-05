<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('seller.create-product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'category'    => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['required', 'string', 'min:20'],
            'price'       => ['required', 'numeric', 'min:0'],
            'images.*'    => ['nullable', 'image', 'max:5120'], // máx 5MB c/u
        ]);

        // TODO: guardar en base de datos cuando tengas el modelo Product
        // Product::create([...$validated, 'user_id' => auth()->id()]);

        return redirect()->route('seller.products.create')
            ->with('success', '¡Producto publicado correctamente!');
    }
}
