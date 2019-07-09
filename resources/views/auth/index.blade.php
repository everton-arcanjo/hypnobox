@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

    <div class="panel panel-default">    
        <div class="panel-heading">Lista de Contatos</div>
        <a href="{{url('usuarios/create')}}"><button class="btn btn-primary">Adicionar</button></a>
        @csrf
            <form method="post" action="{!! url('auth/pesquisar') !!}">
                 @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control form-inline" placeholder="Digite o nome" name="nome">
                        <input type="text" class="form-control form-inline" placeholder="Digite o telefone" name="telefone">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Pesquisar</button>
                        </span>
                        <a class="btn btn-default" href="{{ url('usuarios') }}">Limpar</a>
                    </div>
                </div>
            </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Dt Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>            
                        <tbody>            
                            @foreach($users as $usu)
                                <tr>
                                    <td>{{$usu->id}}</td>
                                    <td>{{$usu->name}}</td>
                                    <td>{{$usu->email}}</td>
                                    <td>
                                        <a href="{{url('usuarios/edit', $contato->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="{{url('usuarios/destroy', $contato->id)}}"><i class="glyphicon glyphicon-trash"></i></a>
                                        <a href="{{url('usuarios/show', $contato->id)}}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                    </td>                                
                                </tr>                         
                               @endforeach                      
                        </tbody>
                    </table> 
                </div> 
            </div>
            <div align="center" class="row">
              
            </div>
    </div>

        </div>
    </div>
</div>
@endsection
