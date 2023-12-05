<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

 
    protected $hidden = [
        'password',
        'remember_token',
    ];

 
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){

        //Uno a muchos
        //Un usuario puede tener muchos post
        return $this -> hasMany(Post::class);
    }

    public function likes(){
        //Un usuario puede hacer muchos likes
        return $this -> hasMany(Like::class);
    }

    //Almacenar Seguidores de un usuario

    //Seguidores
    public function followers(){
        //el metodo followers en la tabla de followers pertenece a muchos usuarios.
        //Como nos salimos de las convenciones de laravel para asignar automaticamente la tabla con los registros.
        //Debemos de indicarle a laravel que tabla y que campos vamos a manipular.
        return $this -> belongsToMany(User::class, 'followers' , 'user_id' ,'follower_id');
    }

    //Almacenar los seguidores que seguimos

    //Siguiendo
    public function followings(){
        //Metodo para obtener a los usuarios que sigo
        //En este caso quiero ver que soy el seguidor que los estoy siguiendo
        return $this -> belongsToMany(User::class, 'followers' ,'follower_id' ,'user_id');
    }

    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        //Iterar en la tabla de seguidores y revisar si ya es un seguidor
        return $this -> followers -> contains( $user -> id);
    }
}
