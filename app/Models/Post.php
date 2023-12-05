<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    public function user()
    {
        //un post pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios(){
        //Un post va a tener muchos comentarios
        return $this-> hasMany(Comentario::class);
    }

    public function likes(){
        //Un post puede tener muchos likes de diferentes personas
        return $this -> HasMany(Like::class);
    }

    public function checkLike(User $user){
        //Checar que el usuario ya haya dado like a una publicacion
        return $this -> likes->contains('user_id',$user -> id);
    }
}
