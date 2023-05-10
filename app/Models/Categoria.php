<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable =["nome"];

    public function getResult($nome = null)
    {
        if(!$nome)
        {
            return $this->get();
        }
        else{

            return $this->where("nome","LIKE","%{$nome}%")->get();
        } 

        }

}
