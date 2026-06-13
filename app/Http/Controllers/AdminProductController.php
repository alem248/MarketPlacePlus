<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\ProductSuspendedMail;
use Illuminate\Support\Facades\Mail;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->orderByDesc('created_at')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'min:10'],
            'category'    => ['required', 'string'],
            'location'    => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'image'       => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = [$request->file('image')->store('products', 'public')];
        }
        $data['user_id']   = auth()->id();
        $data['is_active'] = true;
        unset($data['image']);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Publicación creada correctamente.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // 1. Validamos los datos permitidos
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'min:10'],
            'category'    => ['required', 'string'],
            'location'    => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'is_active'   => ['nullable', 'boolean'],
            'image'       => ['nullable', 'image', 'max:5120'],
        ]);

        // 2. Procesamos imagen si existe
        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = [$request->file('image')->store('products', 'public')];
        }
        $data['is_active'] = $request->boolean('is_active');

        unset($data['image']);


        // Esto es mucho más seguro frente a errores de columnas no encontradas
        $product->fill($data);
        $product->save(); // save() es más robusto ante inconsistencias de esquema

        return redirect()->route('admin.products.index')
            ->with('success', 'Publicación actualizada.');
    }
    public function destroy(Product $product)
    {
        $product->suspend('Eliminado por administrador');

        return redirect()->route('admin.products.index')
            ->with('success', 'Publicación desactivada. Los datos se conservan para auditoría.');
    }

   public function updateStatus(Request $request, Product $product)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        if ($request->is_active == 1) {
            $product->reactivate();
            $product->update([
                'reactivated_at'         => now(),
                'viewed_suspension_at'   => null,
                'viewed_reactivation_at' => null,
            ]);

            return redirect()->back()->with('success', 'La publicación ha sido reactivada con éxito.');
        }

        $product->suspend('Desactivado por administrador');

        return redirect()->back()->with('success', 'La publicación ha sido desactivada.');
    }

   public function suspend(Request $request, Product $product)
{
    $request->validate(['reason' => 'required|string|max:500']);


    $product->update([
        'is_active' => false,
        'suspension_reason' => $request->reason
    ]);

    $product->refresh();

    Mail::to($product->user->email)->send(new ProductSuspendedMail($product));

    return back()->with('success', 'Producto suspendido y notificación enviada.');
}
}
