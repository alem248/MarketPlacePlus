<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    // Lista todos los comentarios paginados con sus relaciones cargadas
    public function index()
    {
        $comments = Comment::with(['user', 'product'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    // Alterna visible/oculto sin eliminar el registro de la base de datos
    public function toggle(Comment $comment)
    {
        if ($comment->is_active) {
            $comment->hide();
            $msg = 'Comentario deshabilitado correctamente.';
        } else {
            $comment->show();
            $msg = 'Comentario habilitado correctamente.';
        }

        return back()->with('success', $msg);
    }
}
