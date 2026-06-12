<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Muestra el detalle completo de un producto al comprador
    public function show(Product $product)
    {
        // Si el producto está desactivado, lo ocultamos con 404
        abort_if(!$product->is_active, 404);

        // Cargamos el vendedor para mostrar su nombre y teléfono en la vista
        $product->load('user');

        return view('products.show', compact('product'));
    }

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
            'user_id'     => auth()->user()->id,
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
        // 1. Obtener todos los productos del usuario
        $products = Product::where('user_id', auth()->id())->get();

        // 2. Obtener el producto suspendido (si existe)
        $suspendedProduct = Product::where('user_id', auth()->id())
            ->where('is_active', false)
            ->whereNotNull('suspension_reason')
            ->first();

        $reactivatedProduct = Product::where('user_id', auth()->id())
        ->where('is_active', true)
        ->whereNotNull('reactivated_at')
        ->whereNull('viewed_reactivation_at')
        ->first();

        // 3. Pasar ambas variables a la vista
        return view('seller.panel', compact('products', 'suspendedProduct', 'reactivatedProduct'));
    }

    public function edit($id)
    {
        $product = Product::where('user_id', auth()->user()->id)->findOrFail($id);
        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // 1. Buscamos el producto asegurando que pertenece al usuario
        $product = Product::where('user_id', auth()->user()->id)->findOrFail($id);

        if (!empty($product->suspension_reason)) {
        return redirect()->back()->with('error', 'Este producto está suspendido y no puede ser modificado. Por favor, contacta a soporte.');
    }

        // 2. Validación
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'removed_images' => 'nullable|array',
            'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 3. Obtenemos las imágenes actuales (usando los casts del modelo si los tienes)
        $activeImages = is_array($product->image_path) ? $product->image_path : (json_decode($product->image_path, true) ?? []);
        $deletedLog = is_array($product->deleted_images_log) ? $product->deleted_images_log : (json_decode($product->deleted_images_log, true) ?? []);

        // 4. Lógica de INHABILITACIÓN (sin borrar físicamente nada)
        if ($request->has('removed_images')) {
            foreach ($request->removed_images as $imageToRemove) {
                // Quitamos la imagen de las activas
                $activeImages = array_diff($activeImages, [$imageToRemove]);

                // La guardamos en el log de auditoría si no existe ya
                if (!in_array($imageToRemove, $deletedLog)) {
                    $deletedLog[] = $imageToRemove;
                }
            }
        }

        // 5. Lógica de ADICIÓN de nuevas imágenes
        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $path = $file->store('products', 'public');
                $activeImages[] = $path;
            }
        }

        // 6. Guardamos los cambios
        // array_values() es fundamental para resetear los índices y evitar errores en la columna JSON
        $product->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'image_path' => array_values($activeImages),
            'deleted_images_log' => array_values($deletedLog),
            'is_active' => $request->has('is_active') ? true : false
        ]);


        return redirect()->back()->with('success', 'El producto se ha actualizado correctamente.');
    }
    public function acknowledge($id)
{
    $product = Product::where('user_id', auth()->id())->findOrFail($id);
    $product->update(['viewed_suspension_at' => now()]); 
    return back();
}

public function acknowledgeReactivation($id)
{
    $product = Product::where('user_id', auth()->id())->findOrFail($id);
    
    $product->update([
        'viewed_reactivation_at' => now()
    ]);

    return redirect()->route('seller.panel');
}
}
