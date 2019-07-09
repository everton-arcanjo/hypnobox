@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2> Contato</h2>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ url('contatos') }}">voltar</a>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nome:</strong>
                                    {{ $contatos->nome }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {{ $contatos->email }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Telefone:</strong>
                                    {{ $contatos->telefone }}
                                </div>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


