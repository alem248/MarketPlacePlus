<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Trato;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Guarda la calificación y comentario del comprador al vendedor.
     * Solo disponible cuando el trato está en estado 'recibido'.
     */
    public function store(Request $request, Trato $trato)
    {
        // Solo el comprador del trato puede calificar
        abort_if($trato->buyer_id !== auth()->id(), 403);

        // Solo se puede calificar si el trato fue recibido
        abort_if($trato->status !== 'recibido', 403);

        // Validación del formulario
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:5|max:500',
        ], [
            'rating.required'  => 'Debes seleccionar al menos una estrella.',
            'content.required' => 'El comentario no puede estar vacío.',
            'content.min'      => 'El comentario debe tener al menos 5 caracteres.',
        ]);

        // Evitar que el mismo comprador califique dos veces el mismo producto
        $yaCalificado = Comment::where('user_id', auth()->id())
            ->where('product_id', $trato->product_id)
            ->exists();

        if ($yaCalificado) {
            return back()->with('error_calificacion', 'Ya enviaste una calificación para este producto.');
        }

        // Guardar el comentario en la base de datos
        Comment::create([
            'user_id'    => auth()->id(),
            'product_id' => $trato->product_id,
            'content'    => $data['content'],
            'rating'     => $data['rating'],
            'is_active'  => true,
        ]);

        return back()->with('success_calificacion', '¡Gracias por tu calificación!');
    }
}
