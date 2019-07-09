<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
     protected $fillable = [
        'nome','email', 'telefone','imagem',
    ];

	 public static function busca($nome, $telefone)
    {
      return static::where('nome', 'LIKE', '%' . $nome . '%')->get();

      if(isset($telefone)){
      	return static::where('telefone', 'LIKE', '%' . $telefone . '%')->get();
      }
    }
}
