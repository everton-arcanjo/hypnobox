<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuarios extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   public static function verifica_usuario($id, $email){

      return DB::table('users')
      ->where('email', $email)
      ->where('id', $id)->get();
      
    }

   public static function atualiza_usuario(array $data){

        DB::table('users')->where('id',$data['id'])
        ->update(array(
             'name' =>$data['name'],
             'email' =>$data['email'],
             'password' =>$data['password'],
        ));     
    }        
}
