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

        @if (!empty($success))
                <div class="alert alert-success" role="alert">
                    {{ $success }}
                </div>        
        @endif  

    <div class="panel panel-default">    
        <div class="panel-heading">Lista de Usuarios</div>
        <a href="{{url('usuarios/create')}}"><button class="btn btn-primary">Adicionar</button></a>
        @csrf
            <form method="post" action="{!! url('usuarios/pesquisar') !!}">
                 @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control form-inline" placeholder="Digite o nome" name="nome">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit">Pesquisar</button>
                        </span>
                        <span class="input-group-btn">
                            <a href="{{ url('usuarios') }}"><button class="btn btn-default">Limpar</button></a>
                        </span>
                    </div>
                </div>

            </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
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
                                        <a href="{{url('usuarios/edit', $usu->id)}}"></a>
                                        <a class="btn btn-primary" href="{{url('usuarios/edit', $usu->id)}}">Editar</a>
                                        <a class="btn btn-info" href="{{url('usuarios/show', $usu->id)}}">Ver</a>
                                        <a class="btn btn-danger" href="{{url('usuarios/destroy', $usu->id)}}">Excluir</a>
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
