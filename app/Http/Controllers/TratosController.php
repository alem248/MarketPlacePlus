<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TratosController extends Controller
{
    public function index()
    {
        // TODO: cuando tengas el modelo Trato, cargar los tratos del usuario:
        // $tratos = Trato::where('user_id', auth()->id())->paginate(10);
        // return view('tratos.index', compact('tratos'));

        return view('tratos.index');
    }
}
