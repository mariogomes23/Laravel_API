<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produto\ProdutoCreateRequest;
use App\Http\Requests\Produto\ProdutoUpdateRequest;
use App\Models\Produto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = $this->produto->getResult($request->nome);

        return response()->json($produtos,201);
        //

    }

    public function store(ProdutoCreateRequest $request)
    {
        $nomeImage = Str::kebab($request->nome).".".$request->image->extension();


        //
        if($request->hasFile("image") && $request->file("image")->isValid()){

            $produtos = $this->produto->create([
                "nome" => $request->nome,
                "categoria_id"=>$request->categoria_id,
                "descricao" =>$request->descricao,
                "image"=>$request->image->storeAs("produtos",$nomeImage)
               ]);
        }
        else
        $produtos = $this->produto->create([
            "nome" => $request->nome,
            "categoria_id"=>$request->categoria_id,
            "descricao" =>$request->descricao
           ]);


        return response()->json($produtos,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produtos = $this->produto->find($id);
         return response()->json($produtos,201);
        //
    }


    public function update(ProdutoUpdateRequest $request, $id)
    {
        $produtos = $this->produto->find($id);


        if($request->hasFile("image") && $request->file("image")->isValid()){

            if(Storage::exists("produtos/{$produtos->image}"))
            {
                Storage::delete("produtos/{$produtos->image}");
            }

            $nomeImage = Str::kebab($request->nome).".".$request->image->extension();

        $produtos->produto->update([
            "nome" => $request->nome,
            "categoria_id"=>$request->categoria_id,
            "descricao" =>$request->descricao,
            "image"=>$request->image->storeAs("produtos",$nomeImage)
           ]);
    }
    else
    $produtos = $this->produto->update([
        "nome" => $request->nome,
        "categoria_id"=>$request->categoria_id,
        "descricao" =>$request->descricao
       ]);
    

        return response()->json($produtos,201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $produtos = $this->produto->destroy($id);

         return response()->json([
            "message"=>"success"
         ]);
    }
}
