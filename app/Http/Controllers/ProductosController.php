<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categorias = DB::table('categorias')->orderBy ('nombre', 'asc')->get();

        return view ('modulos.productos.Productos', compact('categorias'));
    }

    public function GenerarCodigo($id_categoria)
    {

        $producto = Productos::where('id_categoria', $id_categoria)->orderBy('id', 'desc')->first();

        if($producto == null){
            $respuesta = 0;
        }else{
            $respuesta = $producto;
        }
        return response()->json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
    }
}
