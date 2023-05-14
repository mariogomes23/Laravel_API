<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "nome" => ["required","string","unique:produtos,nome,{$this->segment(3)},id"],
            "categoria_id" => ["required","exists:categorias,id"],
            "descricao" => ["required","string"],
            "image" => ["image"]
            //
        ];
    }
}
