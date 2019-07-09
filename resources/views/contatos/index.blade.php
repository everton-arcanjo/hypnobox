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
        <a href="{{url('contatos/create')}}"><button class="btn btn-primary">Adicionar</button></a>
        @csrf
            <div class="box">
                <div class="box-header">
                    <form action="{!! url('contatos/pesquisar') !!}" method="POST" class="form form-inline">
                    @csrf   
                    <input type="text" class="form-control" placeholder="Digite o nome" name="nome">
                    <input type="text" class="form-control" placeholder="Digite o nome" name="telefone">            

                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                    <a href="{{ url('contatos') }}"><button class="btn btn-default">Limpar</button></a>
                    </form>
                </div>                
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>            
                        <tbody>            
                            @foreach($contatos as $contato)
                                <tr>
                                    <td class="col"><img src="{{ asset('images/' . basename($contato->imagem)) }}" alt="{{$contato->imagem}}" class="img-thumbnail" style="max-width:20%; min-height:20%;"></td>                                    
                                    <td>{{$contato->nome}}</td>
                                    <td>{{$contato->email}}</td>
                                    <td>{{$contato->telefone}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{url('contatos/edit', $contato->id)}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a class="btn btn-info" href="{{url('contatos/show', $contato->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        <a class="btn btn-danger" href="{{url('contatos/destroy', $contato->id)}}"><span class="glyphicon glyphicon-remove"></span></a>
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
