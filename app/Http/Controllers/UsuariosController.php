<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
 {

//     public function PrimerUsuario()
//     {
//         User::create([
//             'name' => 'jackie',
//             'email' => 'admin@gmail.com',
//             'foto' => '',
//             'estado' => '1',
//             'ultimo_login' => '',
//             'rol' => 'Aministrador',
//             'password' =>Hash::make('123'),
//             'id_sucursal' =>1,


//         ]);
//     }
   
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
