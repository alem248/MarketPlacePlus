<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
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
            $data['image_path'] = $request->file('image')->store('products', 'public');
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
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        // 3. Normalizamos is_active
        $data['is_active'] = $request->boolean('is_active');

        // 4. ELIMINAMOS cualquier campo que no sea de la tabla si es necesario
        unset($data['image']);

        // 5. USAMOS fill() y save() en lugar de update() masivo
        // Esto es mucho más seguro frente a errores de columnas no encontradas
        $product->fill($data);
        $product->save(); // save() es más robusto ante inconsistencias de esquema

        return redirect()->route('admin.products.index')
            ->with('success', 'Publicación actualizada.');
    }
    public function destroy(Product $product)
    {
        // Soft delete: solo desactivar el producto, no eliminar datos
        $product->reactivate(); // Primero limpiamos el motivo anterior
        $product->suspend('Eliminado por administrador');

        return redirect()->route('admin.products.index')
            ->with('success', 'Publicación desactivada. Los datos se conservan para auditoría.');
    }

    public function updateStatus(Request $request, Product $product)
    {
        // Validamos que el estado sea un booleano (activo o pendiente)
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $product->is_active = $request->is_active;
        $product->save();

        return response()->json(['success' => true, 'message' => 'Estado actualizado.']);
    }

    public function suspend(Request $request, Product $product)
    {
        $request->validate(['reason' => 'required|string|max:500']);

        // 1. Actualizar el producto
        $product->update([
            'is_active' => false,
            'suspension_reason' => $request->reason
        ]);

        // 2. Enviar correo al usuario dueño del producto
        Mail::to($product->user->email)->send(new ProductSuspendedMail($product));

        return back()->with('success', 'Producto suspendido y notificación enviada.');
    }
}
