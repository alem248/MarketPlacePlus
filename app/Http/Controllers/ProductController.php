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
            'title'        => ['required', 'string', 'max:200'],
            'category'     => ['required', 'string'],
            'location'     => ['required', 'string'],
            'description'  => ['required', 'string', 'min:20'],
            'price'        => ['required', 'numeric', 'min:0'],
            'image_path'   => ['required', 'array'],
            'image_path.*' => ['image', 'max:5120'],
        ]);

        $paths = [];
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $paths[] = $file->store('products', 'public');
            }
        }

        Product::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'category'    => $request->category,
            'location'    => $request->location,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $paths,
            'is_active'   => true,
        ]);

        return redirect()->route('seller.products.create')
            ->with('success', '¡Producto publicado correctamente!');
    }

   public function dashboard()
{
    $products = Product::where('user_id', auth()->id())->get();
    return view('seller.panel', compact('products'));
}

public function edit($id)
{
    $product = Product::where('user_id', auth()->id())->findOrFail($id);
    return view('seller.products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::where('user_id', auth()->id())->findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'location' => 'required|string|max:255',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
    ]);

    $product->title = $request->title;
    $product->category = $request->category;
    $product->price = $request->price;
    $product->location = $request->location;

    if ($request->hasFile('images')) {
        $images = [];
        foreach ($request->file('images') as $file) {
            $images[] = $file->store('products', 'public');
        }
        $product->image_path = $images;
    }

    $product->save();

    return redirect()->route('seller.panel')->with('success', 'Producto actualizado con éxito.');
}
}