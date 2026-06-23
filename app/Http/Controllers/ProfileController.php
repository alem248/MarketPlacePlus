<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ], [
            'foto.required' => 'Debes seleccionar una imagen.',
            'foto.image'    => 'El archivo debe ser una imagen.',
            'foto.mimes'    => 'Solo se admiten archivos PNG, JPG y JPEG.',
            'foto.max'      => 'La imagen no debe superar los 3 MB.',
        ]);

        $user = auth()->user();

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $path = $request->file('foto')->store('profile-photos', 'public');
        $user->update(['foto' => $path]);

        return back()->with('photo_success', 'Foto de perfil actualizada correctamente. Solo se admiten PNG, JPG y JPEG.');
    }
}
