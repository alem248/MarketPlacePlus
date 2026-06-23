<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Favorite;
use App\Models\FavoriteCollection;
use App\Models\Product;
use App\Models\User;

class FavoriteController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $collections = FavoriteCollection::where('user_id', $userId)
            ->withCount('favorites')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($col) {
                $col->sample = Favorite::where('collection_id', $col->id)
                    ->with('product')
                    ->latest()
                    ->limit(4)
                    ->get()
                    ->map(function ($fav) {
                        if (!$fav->product) return null;
                        $images = $fav->product->image_path ?? [];
                        $thumb  = $images[0] ?? null;
                        if (!$thumb) return null;
                        return Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb);
                    })
                    ->filter()
                    ->values();
                return $col;
            });

        $favProductIds = Favorite::where('user_id', $userId)->distinct()->pluck('product_id');

        $favoriteProducts = Product::whereIn('id', $favProductIds)
            ->where('is_active', true)
            ->orderBy('title')
            ->get()
            ->map(function ($p) {
                $images   = $p->image_path ?? [];
                $thumb    = $images[0] ?? null;
                $p->imgSrc = $thumb
                    ? (Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb))
                    : null;
                return $p;
            });

        return view('favorites.index', compact('collections', 'favoriteProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|exists:products,id',
            'collection_id' => 'required|exists:favorite_collections,id',
        ]);

        $collection = FavoriteCollection::where('id', $request->collection_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Favorite::firstOrCreate([
            'user_id'       => auth()->id(),
            'product_id'    => $request->product_id,
            'collection_id' => $collection->id,
        ]);

        return response()->json(['status' => 'added']);
    }

    public function destroy(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        Favorite::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['status' => 'removed']);
    }

    public function collections()
    {
        $cols = FavoriteCollection::where('user_id', auth()->id())
            ->orderBy('name')
            ->get(['id', 'name']);
        return response()->json($cols);
    }

    public function storeCollection(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $col = FavoriteCollection::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
        ]);

        return response()->json(['id' => $col->id, 'name' => $col->name]);
    }

    public function showCollection(FavoriteCollection $collection)
    {
        abort_if($collection->user_id !== auth()->id(), 403);

        $products = Favorite::where('collection_id', $collection->id)
            ->with('product')
            ->latest()
            ->get()
            ->map(function ($fav) {
                $p = $fav->product;
                if (!$p || !$p->is_active) return null;
                $images   = $p->image_path ?? [];
                $thumb    = $images[0] ?? null;
                $p->imgSrc = $thumb
                    ? (Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb))
                    : null;
                return $p;
            })
            ->filter()
            ->values();

        return view('favorites.collection', compact('collection', 'products'));
    }

    public function destroyFromCollection(FavoriteCollection $collection, Product $product)
    {
        abort_if($collection->user_id !== auth()->id(), 403);

        Favorite::where('collection_id', $collection->id)
            ->where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json(['status' => 'removed']);
    }

    public function destroyCollection(FavoriteCollection $collection)
    {
        abort_if($collection->user_id !== auth()->id(), 403);
        $collection->delete();
        return response()->json(['status' => 'deleted']);
    }
}
