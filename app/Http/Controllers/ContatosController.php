<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Contatos;

class ContatosController extends Controller
{

	public function index()
    {
        $contatos = \App\Contatos::all();

        return view('contatos.index',compact('contatos'));
    }

	protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contatos'],
            'telefone' => ['required', 'string', 'min:11', 'unique:contatos'],
        ]);
    }

 	public function create()
    {
    	
        return view('contatos.cadastro');
    }

	public function show(Contatos $contatos, $id)
    {
    	$contatos = \App\Contatos::find($id);
    	return view('contatos.show',compact('contatos'));
    }    

	public function store(Request $request)
    {
		if($request->hasfile('imagem'))
         {
            $file = $request->file('imagem');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
         }  

    	$dadosFormulario = array(
    		'nome' => $request->get('nome'),
    		'email' => $request->get('email'),
    		'telefone' => $request->get('telefone'),
    		'imagem' => $name
    	);

		$validator = Validator::make($dadosFormulario, [
            'nome' => ['required', 'string', 'max:255', 'unique:contatos'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contatos'],
            'telefone' => ['required', 'string', 'min:11', 'unique:contatos'],
            'imagem' => ['required','string'],
        ]);  

		if($validator->fails()){
        	return Redirect::to('contatos/create')->withErrors($validator)->withInput();
        }          	

		$contatos = new \App\Contatos;

        $contatos->nome = $request->get('nome');
        $contatos->email = $request->get('email');
        $contatos->telefone = $request->get('telefone');
        $contatos->imagem = $name;
        $contatos->save();
       
       $contatos = \App\Contatos::all();
        return view('contatos.index',compact('contatos'));
    } 


 	public function edit($id)
    {
        $contatos = \App\Contatos::find($id);
    	return view('contatos.edit',compact('contatos', 'id'));
    }

 	public function update(Request $request, Contatos $contatos)
    {

    	 $contatos = Contatos::find($request->id);

    	 if(isset($contatos)) {

            $contatos->nome = $request->input('nome');
            $contatos->email = $request->input('email');
            $contatos->telefone = $request->input('telefone');
            $contatos->save();

        }
        return redirect('/contatos')->with('success','Contato atualizado com sucesso');
    }    

	public function destroy($id)
    {
        $contatos = Contatos::find($id);
        $contatos->delete();

         $contatos = Contatos::all();
        return redirect('/contatos')->with('success','Contato excluido com sucesso!');
    }

	

	public function pesquisar(Request $request)
    {
    	$contatos = new \App\Contatos;

        $contatos->nome = $request->get('nome');
        $contatos->telefone = $request->get('telefone');

        $contatos = Contatos::busca($contatos->nome, $contatos->telefone);
        return view('contatos.index', [
            'contatos' => $contatos,
            'nome' => $request->nome,
            'telefone' =>$request->telefone
        ]);
    }

}
