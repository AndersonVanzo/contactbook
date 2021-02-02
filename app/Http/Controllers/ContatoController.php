<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Illuminate\Cache\Repository;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Input\Input;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all()->toArray();
        return array_reverse($contatos);
    }

    public function store(Request $request)
    {

        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $contato = new Contato;
        $nome = $request->input('nome');
        $endereco = $request->input('endereco');
        $nascimento = $request->input('nascimento');

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('foto')->storeAs('uploads', $file_name, 'public');
            $contato->nome = $nome;
            $contato->endereco = $endereco;
            $contato->nascimento = $nascimento;
            $contato->foto = `/storage/`.$file_path;

            $contato->save();
        } else {
            $contato->nome = $nome;
            $contato->endereco = $endereco;
            $contato->nascimento = $nascimento;
            $contato->foto = '/storage/default-user.png';

            $contato->save();
        }

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
