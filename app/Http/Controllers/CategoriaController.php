<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function store(Request $request)
    {
        Validator::validate($request->all(), [
            'nombre' => 'required|unique:categorias',
        ]);
        $categoria = Categoria::Create($request->all());
        return response()->json(['Message' => 'Categoría creada', 'Data' => $categoria], 200);
    }
    public function show(Request $request)
    {
        $categoria = Categoria::query()->findOrFail($request->get('id'));
        return response()->json(['Message' => $categoria, 'Data' => $categoria]);
    }
}
