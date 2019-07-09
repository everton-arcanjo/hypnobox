<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contatos;

class ControllerContatosApi extends Controller
{
    public function indexView()
    {
        
        return view('contatos_api');
    }
    
    public function index()
    {
        $contatos = Contatos::all();
        return $contatos->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contatos = new Contatos();
        $contatos->nome = $request->input('nome');
        $contatos->email = $request->input('email');
        $contatos->telefone = $request->input('telefone');
        $contatos->imagem = $request->input('imagem');
        $contatos->save();
        return json_encode($contatos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contatos = Contatos::find($id);
        if (isset($contatos)) {
            return json_encode($contatos);            
        }
        return response('Contato não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contatos = Contatos::find($id);
        if (isset($contatos)) {
            $contatos->nome = $request->input('nome');
            $contatos->email = $request->input('email');
            $contatos->telefone = $request->input('telefone');
            $contatos->imagem = $request->input('imagem');
            $contatos->save();
            return json_encode($contatos);
        }
        return response('Contato não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contatos = Contatos::find($id);
        if (isset($contatos)) {
            $contatos->delete();
            return response('OK', 200);
        }
        return response('Contato não encontrado', 404);
    }
}