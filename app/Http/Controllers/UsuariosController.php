<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Usuarios;
use Illuminate\Support\Facades\DB;
class UsuariosController extends Controller
{

    use RegistersUsers;

    public function index()
    {
        $users = \App\User::all();

        return view('usuarios.index',compact('users'));
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
           'email' => ['required', Rule::unique('users')->ignore($data['id'])],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function create()
    {
        
        return view('usuarios.cadastrar');
    }

    public function show(User $usuarios, $id)
    {
        $usuarios = \App\User::find($id);
        return view('usuarios.show',compact('usuarios'));
    }    

    public function store(Request $request)
    {
        $dadosFormulario = array(
            'name' => $request->get('nome'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        $validator = Validator::make($dadosFormulario, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:11', 'unique:users'],
        ]);  

        if($validator->fails()){

            return Redirect::to('usuarios/create')->withErrors($validator)->withInput();

        } else{
            $usuarios = new \App\User;

            $usuarios->nome = $request->get('nome');
            $usuarios->email = $request->get('email');
            $usuarios->password = $request->get('password');
            $usuarios->save();
           
           $usuarios = \App\User::all();
            return view('usuarios.index',compact('usuarios'));            
        }           
    } 


    public function edit($id)
    {
        $usuarios = \App\User::find($id);

        return view('usuarios.edit',compact('usuarios'));
    }

    public function update(Request $request, User $usuarios)
    {
        $user = User::find($request->email);

        if(!empty($user) && $user != null){
            return Redirect::to('usuarios/edit')->withErrors($validator)->withInput();
        } else {

            $usuarios = User::find($request->id);

            if(isset($usuarios)) {

                $usuarios->name = $request->input('name');
                $usuarios->email = $request->input('email');
                $usuarios->password = Hash::make($request->input('password'));
                $usuarios->update();

            }

            return redirect('/usuarios')->with('success','Contato atualizado com sucesso');            
        }
    }    

    public function destroy($id)
    {
        $usuarios = User::find($id);
        $usuarios->delete();

         $usuarios = User::all();

        
        return Redirect::to('usuarios/')->withSuccess('Excluido com sucesso');
    }

    

    public function pesquisar(Request $request)
    {
        $usuarios = new \App\User;

        $usuarios->nome = $request->get('nome');
        $usuarios->telefone = $request->get('telefone');

        $usuarios = User::busca($usuarios->nome);
        return view('usuarios.index', [
            'usuarios' => $usuarios,
            'nome' => $request->nome
        ]);
    }

}
