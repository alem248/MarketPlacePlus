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
            'title'    => ['required', 'string', 'max:150'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'end_date' => ['nullable', 'date'],
            'image'    => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }
        $data['is_active'] = true;
        unset($data['image']);

        Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner creado correctamente.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title'     => ['required', 'string', 'max:150'],
            'link_url'  => ['nullable', 'string', 'max:255'],
            'end_date'  => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
            'image'     => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $request->file('image')->store('banners', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image']);

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner actualizado correctamente.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner eliminado.');
    }
}
