<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderByDesc('is_active')->orderByDesc('created_at')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:255'],
            'zone'        => ['required', 'in:hero,sidebar'],
            'link_url'    => ['nullable', 'string', 'max:255'],
            'end_date'    => ['nullable', 'date'],
            'image'       => ['nullable', 'image', 'max:5120'],
        ]);

        // Desactiva el banner que ya ocupa esa zona
        Banner::where('zone', $data['zone'])->where('is_active', true)->update(['is_active' => false]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }
        $data['is_active'] = true;
        unset($data['image']);

        Banner::create($data);

        $zoneName = $data['zone'] === 'hero' ? 'Principal (Hero)' : 'Lateral (Sidebar)';
        return redirect()->route('admin.banners.index')
            ->with('success', "Banner creado y activado en zona {$zoneName}.");
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:255'],
            'zone'        => ['nullable', 'in:hero,sidebar'],
            'link_url'    => ['nullable', 'string', 'max:255'],
            'end_date'    => ['nullable', 'date'],
            'is_active'   => ['nullable', 'boolean'],
            'image'       => ['nullable', 'image', 'max:5120'],
        ]);

        $newIsActive = $request->boolean('is_active');
        // Mantiene la zona existente si el form no la envía (formularios inline)
        $newZone = $data['zone'] ?? $banner->zone;

        // No se puede activar un banner sin zona asignada
        if ($newIsActive && !$newZone) {
            return redirect()->route('admin.banners.edit', $banner)
                ->with('error', 'Debes asignar una zona (Hero o Sidebar) antes de activar este banner.');
        }

        // Si se activa este banner, desactiva cualquier otro en la misma zona
        if ($newIsActive && $newZone) {
            Banner::where('zone', $newZone)
                ->where('is_active', true)
                ->where('id', '!=', $banner->id)
                ->update(['is_active' => false]);
        }

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }

        $data['is_active'] = $newIsActive;
        $data['zone']      = $newZone;
        unset($data['image']);

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner actualizado correctamente.');
    }

    public function destroy(Banner $banner)
    {
        $banner->suspend();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner desactivado. Los datos se conservan para auditoría.');
    }
}
