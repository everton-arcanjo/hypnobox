@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuario') }}</div>
                <div class="pull-right">
                    <a class="btn btn-primary btn-lg btn-block" href="{{ url('usuarios') }}">voltar</a>
                </div>

                <div class="card-body">
                    <div class="row">
                            <div class="col-lg-12 margin-tb">

                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nome:</strong>
                                    {{ $usuarios->name }}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {{ $usuarios->email }}
                                </div>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

