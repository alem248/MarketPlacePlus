<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $q        = $request->input('q', '');
        $category = $request->input('category', '');
        $location = $request->input('location', '');

        $query = Product::where('is_active', true)->with('user');

        if ($q !== '') {
            $lower = mb_strtolower($q);
            $query->where(function ($sq) use ($lower) {
                $sq->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                   ->orWhereRaw('LOWER(category) LIKE ?', ["%{$lower}%"]);
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($location !== '') {
            $lower = mb_strtolower($location);
            $query->whereRaw('LOWER(location) LIKE ?', ["%{$lower}%"]);
        }

        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $heroBanner = Banner::where('is_active', true)->where('zone', 'hero')->first();
        $sideBanner = Banner::where('is_active', true)->where('zone', 'sidebar')->first();

        return view('auth.home', compact('products', 'heroBanner', 'sideBanner'));
    }

    public function search(Request $request)
    {
        $q          = $request->input('q', '');
        $category   = $request->input('category', '');
        $location   = $request->input('location', '');
        $conditions = $request->input('conditions', []);
        $priceMin   = $request->input('price_min', '');
        $priceMax   = $request->input('price_max', '');

        $query = Product::where('is_active', true);

        if ($q !== '') {
            $lower = mb_strtolower($q);
            $query->where(function ($sq) use ($lower) {
                $sq->whereRaw('LOWER(title) LIKE ?', ["%{$lower}%"])
                   ->orWhereRaw('LOWER(category) LIKE ?', ["%{$lower}%"]);
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($location !== '') {
            $lower = mb_strtolower($location);
            $query->whereRaw('LOWER(location) LIKE ?', ["%{$lower}%"]);
        }

        if (!empty($conditions)) {
            $query->whereIn('condition', $conditions);
        }

        if ($priceMin !== '') {
            $query->where('price', '>=', (float) $priceMin);
        }

        if ($priceMax !== '') {
            $query->where('price', '<=', (float) $priceMax);
        }

        $total    = $query->count();
        $products = $query->latest()->limit(8)->get()->map(function ($p) {
            $images = $p->image_path ?? [];
            $thumb  = $images[0] ?? null;
            $imgSrc = null;
            if ($thumb) {
                $imgSrc = Str::startsWith($thumb, 'http') ? $thumb : Storage::url($thumb);
            }
            return [
                'id'        => $p->id,
                'title'     => $p->title,
                'category'  => $p->category,
                'location'  => $p->location,
                'price'     => number_format($p->price, 2),
                'condition' => $p->condition,
                'image'     => $imgSrc,
                'url'       => route('products.show', $p),
            ];
        });

        $categories = Product::where('is_active', true)
            ->whereNotNull('category')->where('category', '!=', '')
            ->distinct()->orderBy('category')->pluck('category')->values();

        $locations = Product::where('is_active', true)
            ->whereNotNull('location')->where('location', '!=', '')
            ->distinct()->orderBy('location')->pluck('location')->values();

        return response()->json([
            'products' => $products,
            'filters'  => compact('categories', 'locations'),
            'total'    => $total,
        ]);
    }
}
