<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Peticione;
use Illuminate\Http\Request;

class PeticioneController extends Controller
{
    public function index(Request $request)
    {
        $peticiones = Peticione::all();
        return response()->json(['Message' => 'Peticiones encontradas:', 'Data' => $peticiones]);
    }

    public function listMine(Request $request)
    {
        $id = $request->input('id');
        $peticiones = Peticione::all()->where('user_id', '=', $id);
        return response()->json(['Message' => 'Peticiones encontradas en función listMine:', 'Data' => $peticiones]);
    }

    public function show(Request $request, $id)
    {
        $peticion = Peticione::query()->findOrFail($id);
        return response()->json(['Message' => 'Petición encontrada:', 'Data' => $peticion]);
    }

    public function update(Request $request, $id)
    {
        $peticion = Peticione::query()->findOrFail($id);
        $peticion->update($request->all());
        return response()->json(['Message' => 'Petición actualizadas:', 'Data' => $peticion]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'destinatario' => 'required|max:255',
            'categoria_id' => 'required|max:255',
        ]);
        $input = $request->all();
        $category = Categoria::query()->findOrFail($input['categoria_id']);
        $user = 1;
        $peticion = new Peticione($input);
        $peticion->user()->associate($user);
        $peticion->categoria()->associate($category);
        $peticion->firmantes = 0;
        $peticion->estado = 'pendiente';
        $peticion->save();
        return response()->json(['Message' => 'Petición creada:', 'Data' => $peticion]);
    }

    public function firmar(Request $request, $id)
    {
        $peticion = Peticione::query()->findOrFail($id);
        $user = 1; //??
        $user_id = [$user];
        $peticion->firmas()->attach($user_id);
        $peticion->firmantes = $peticion->firmantes + 1;
        $peticion->save();
        return response()->json(['Message' => 'Petición firmada', 'Data' => $peticion]);
    }

    public function cambiarEstado(Request $request, $id)
    {
        $peticion = Peticione::query()->findOrFail($id);
        $peticion->estado = 'Aceptada';
        $peticion->save();
        return response()->json(['Message' => 'Estado cambiado', 'Data' => $peticion]);
    }
    public function delete(Request $request,$id){
        $peticion = Peticione::query()->findOrFail($id);
        $peticion->delete();
        return response()->json(['Message'=>'Petición eliminada']);
    }
}


