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
    <a href="{{url('contatos')}}"><button class="btn btn-primary">Adicionar</button></a>    
        <div class="panel-heading">Lista de Contatos</div>
            <form method="GET" action="">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Digite o nome ou Telefone" name="buscar">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Pesquisar</button>
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
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Dt Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>            
                        <tbody>            
                           
                                <tr>
                                    <td>qqqqqqqq</td>
                                    <td>qaaaaaaa</td>
                                    <td>sasaassass</td>
                                    <td>marcea</td>
                                    <td>
                                        <a href=""><i class="glyphicon glyphicon-zoom-in"></i></a>
                                        <a href=""><i class="glyphicon glyphicon-trash"></i></a>
                                        <a href=""><i class="glyphicon glyphicon-zoom-in"></i></a>
                                    </td>                                
                                </tr>                         
                                                    
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
