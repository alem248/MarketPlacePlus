<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')->orderBy('first_name')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:admin,user'],
        ]);

        // No permitir que el admin se quite su propio rol
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Rol de {$user->first_name} actualizado a {$request->role}.");
    }
}
