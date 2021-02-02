<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Illuminate\Cache\Repository;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all()->toArray();
        return array_reverse($contatos);
    }

    public function store(Request $request)
    {
        $contato = new Contato([
            'nome' => $request->input('nome'),
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'nascimento' => $request->input('nascimento'),
        ]);

        $contato->save();

        return response()->json('Contato salvo!');
    }

    public function show($id)
    {
        $contato = Contato::find($id);
        return response()->json($contato);
    }

    public function update($id, Request $request)
    {
        $contato = Contato::find($id);
        $contato->update($request->all());

        return response()->json('Contato atualizado!');
    }

    public function destroy($id)
    {
        $contato = Contato::find($id);
        $contato->delete();

        return response()->json('Contato apagado!');
    }
}
