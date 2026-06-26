<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Lista todos los comentarios paginados con sus relaciones cargadas
     */
    public function index()
    {
        $comments = Comment::with(['user', 'product'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Deshabilitar un comentario con un motivo (desde el modal)
     */
    public function disableWithReason(Request $request, Comment $comment)
    {
        $request->validate([
            'admin_message' => 'required|string|min:5|max:500',
        ], [
            'admin_message.required' => 'Debes escribir un motivo para deshabilitar el comentario.',
            'admin_message.min' => 'El motivo debe tener al menos 5 caracteres.',
            'admin_message.max' => 'El motivo no puede exceder los 500 caracteres.',
        ]);

        $comment->update([
            'is_active' => false,
            'admin_message' => $request->admin_message,
        ]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Comentario deshabilitado correctamente.');
    }

    /**
     * Habilitar un comentario (desde el botón "Habilitar")
     */
    public function enable(Comment $comment)
    {
        $comment->update([
            'is_active' => true,
            'admin_message' => null,
        ]);

        return redirect()->route('admin.comments.index')
            ->with('success', 'Comentario habilitado correctamente.');
    }

    /**
     * Alterna visible/oculto (método original, lo dejamos por compatibilidad)
     */
    public function toggle(Comment $comment)
    {
        if ($comment->is_active) {
            $comment->update([
                'is_active' => false,
                'admin_message' => null,
            ]);
            $msg = 'Comentario deshabilitado correctamente.';
        } else {
            $comment->update([
                'is_active' => true,
                'admin_message' => null,
            ]);
            $msg = 'Comentario habilitado correctamente.';
        }

        return back()->with('success', $msg);
    }
}