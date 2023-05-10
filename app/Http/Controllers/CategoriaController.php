<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;

    }

    public function index(Request $request)
    {
        //
        $categoria = $this->categoria->getResult($request->nome);

        return response()->json($categoria,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoriaRequest $request)
    {
       $categoria =  $this->categoria->create([
            "nome"=>$request->nome
        ]);


         return response()->json($categoria,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = $this->categoria->findOrFail($id);
        return response()->json($categoria,200);
        //
    }

    public function update(StoreUpdateCategoriaRequest $request, string $id)
    {
        //
        $categoria = $this->categoria->findOrFail($id);
        $categoria->update([
            "nome"=>$request->nome
        ]);
        return response()->json($categoria,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = $this->categoria->destroy($id);

        return response()->json([
            "message"=>"sucess"
        ],204);
        //
    }
}
