<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = DB::table('categorias')->orderBy('nombre','asc')->get();
       return view('modulos.productos.Categorias', compact('categorias'));
    }


    public function store(Request $request)
    {
        DB::table('categorias')->insert(['nombre'=>$request->nombre]);
        return redirect ('Categorias')->with('success','Categoria creada con exito');
    }

   
    public function edit($id_categoria)
    {
       $categoria = DB::table('categorias')->where('id', $id_categoria)->first();
       return response()->json($categoria); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::table('categorias')->where('id', $request->id)->update(['nombre'=>$request->nombre]);
        return redirect ('Categorias')->with('success', 'Categoria actualizada con exito');
    }

   
    public function destroy( $id_categoria)
    {
        DB::table('categorias')->where('id', $id_categoria)->delete();

        return redirect ('Categorias');
    }
}
