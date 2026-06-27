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

    // =============================================
    // NUEVOS MÉTODOS PARA EDITAR COMENTARIOS
    // =============================================

    /**
     * Mostrar formulario de edición de comentario
     */
    public function edit(Comment $comment)
    {
        // Verificar que el comentario pertenece al usuario autenticado
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este comentario.');
        }

        // Verificar que el comentario esté deshabilitado (opcional)
        // Si quieres permitir editar siempre, elimina esta verificación
        if ($comment->is_active) {
            return redirect()->back()->with('error', 'Este comentario ya está activo y no necesita edición.');
        }

        return view('user.comments.edit', compact('comment'));
    }

    /**
     * Actualizar el comentario
     */
    public function update(Request $request, Comment $comment)
    {
        // Verificar que el comentario pertenece al usuario autenticado
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este comentario.');
        }

        // Validación
        $request->validate([
            'content' => 'required|string|min:5|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ], [
            'content.required' => 'El comentario no puede estar vacío.',
            'content.min' => 'El comentario debe tener al menos 5 caracteres.',
            'content.max' => 'El comentario no puede exceder los 500 caracteres.',
            'rating.integer' => 'La calificación debe ser un número.',
            'rating.min' => 'La calificación mínima es 1 estrella.',
            'rating.max' => 'La calificación máxima es 5 estrellas.',
        ]);

        // Actualizar el comentario
        $comment->update([
            'content' => $request->content,
            'rating' => $request->rating ?? $comment->rating,
            'is_active' => false, // Sigue deshabilitado hasta que el admin lo revise
            'admin_message' => null, // Limpiamos el mensaje del admin
        ]);

        return redirect()->route('home')
            ->with('success', 'Tu comentario ha sido actualizado. Queda pendiente de revisión por el administrador.');
    }
}