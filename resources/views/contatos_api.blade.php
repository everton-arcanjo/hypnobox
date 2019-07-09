@extends('layouts.app')

@section('content')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Contatos</h5>

        <table class="table table-ordered table-hover" id="tabelaContatos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Imagem<th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoContato()">Novo Contato</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgContatos">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formContato">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Contato</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nome" class="control-label">Nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nome" placeholder="Nome">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Email" class="control-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" placeholder="email">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Email" class="control-label">Email</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="telefone" placeholder="Telefone">
                        </div>
                    </div>                                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoContato() {
        $('#id').val('');
        $('#nome').val('');
        $('#email').val('');
        $('#telefone').val('');
        $('#dlgContatos').modal('show');
    }
    
    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.email + "</td>" +
            "<td>" + p.telefone+ "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('/api/contatos/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#email').val(data.email);
            $('#telefone').val(data.telefone);
            $('#dlgContatos').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/contatos/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaContatos>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    
    function carregarContatos() {
        $.getJSON('/api/contatos', function(contatos) { 
            for(i=0;i<contatos.length;i++) {
                linha = montarLinha(contatos[i]);
                $('#tabelaContatos>tbody').append(linha);
            }
        });        
    }
    
    function criarContato() {
        contatos = { 
            nome: $("#nome").val(), 
            email: $("#email").val(), 
            telefone: $("#telefone").val(), 
             
        };

        $.post("/api/contatos", contatos, function(data) {
            contatos = JSON.parse(data);
            linha = montarLinha(contatos);
            $('#tabelaContatos>tbody').append(linha);            
        });
    }
    
    function salvarContato() {
        contatos = { 
            id : $("#id").val(), 
            nome: $("#nome").val(), 
            email: $("#email").val(), 
            telefone: $("#telefone").val(), 
             
        };
        $.ajax({
            type: "PUT",
            url: "/api/contatos/" + contatos.id,
            context: this,
            data: contatos,
            success: function(data) {
                contatos = JSON.parse(data);
                linhas = $("#tabelaContatos>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == contatos.id );
                });
                if (e) {
                    e[0].cells[0].textContent = contatos.id;
                    e[0].cells[1].textContent = contatos.nome;
                    e[0].cells[2].textContent = contatos.email;
                    e[0].cells[3].textContent = contatos.telefone;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formContato").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarContato();
        else
            criarContato();
            
        $("#dlgContatos").modal('hide');
    });
    
    $(function(){
        carregarContatos();
    })
    
</script>
@endsection

