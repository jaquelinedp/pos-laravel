<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
       if (auth()->user()->rol != 'Administrador') {
            return redirect ('Inicio');
        }

        $sucursales = Sucursales::all();
        return view('modulos.users.Sucursales', compact('sucursales'));

    }  


    public function store(Request $request)
    {
       
            Sucursales::create([
                'nombre' => $request->nombre,
                'estado' => 1,
            ]);

            return redirect ('Sucursales')->with('success', 'Sucursal creada con exito');

    }

    public function edit($id_sucursal)
    {
     $sucursal= Sucursales::find ($id_sucursal);

     return response ()->json($sucursal);
    }

    
    public function update(Request $request)
    {
        Sucursales::where ('id', $request->id)->update([
            'nombre' => $request->nombre
        ]);

        return redirect ('Sucursales')->with('success', 'Sucursal actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sucursales $sucursales)
    {
        //
    }
}
