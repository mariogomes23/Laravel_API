<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable =["nome","descricao","image","categoria_id"];

    public function getResult($nome){
        if(!$nome)
        {
            return $this->get();

        }
       return  $this->where("nome","LIKE","%{$nome}%")->get();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
