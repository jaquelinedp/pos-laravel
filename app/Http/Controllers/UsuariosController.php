<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
 {
    public function __construct()
    {
        $this->middleware('auth');
    }

//     public function PrimerUsuario()
//     {
//         User::create([
//             'name' => 'jackie',
//             'email' => 'admin@gmail.com',
//             'foto' => '',
//             'estado' => '1',
//             'ultimo_login' => '',
//             'rol' => 'Administrador',
//             'password' =>Hash::make('123'),
//             'id_sucursal' =>1,


//         ]);
//     }
public function ActualizarMisDatos(Request $request)
{

    if(auth()->user()->email != request('email')){

        if(request('password')){

            $datos = request()-> validate([

                'name'=>['required', 'string', 'max:50'],
                'email'=>['required',  'email', 'unique:users'],
                'password'=>['required', 'string', 'min:3']
                
            ]);
        }else{
            $datos = request()-> validate([

                'name'=>['required', 'string', 'max:50'],
                'email'=>['required',  'email', 'unique:users']
              
                
            ]);
        }
    }else{
        if(request('password')){
            $datos = request()-> validate([

                'name'=>['required', 'string', 'max:50'],
                'email'=>['required',  'email'],
                'password'=>['required', 'string', 'min:3']
                
            ]);
        }else{
            $datos = request()-> validate([

                'name'=>['required', 'string', 'max:50'],
                'email'=>['required',  'email', 'unique:users']
              
                
            ]);
        }
    }
    if(request('fotoPerfil')){
        if(auth()->user()->foto != ''){
        $path =storage_path('app/public/'.auth()->user()->foto);
        unlink($path);
        }

        $rutaImg = $request->file('fotoPerfil')->store('users', 'public');

    }else{
        $rutaImg = auth()->user()->foto;
    }

    if(isset($datos["password"])){

       DB::table('users')->where ('id', auth()->user()->id)
       ->update([

        'name'=>$datos["name"],
        'email' =>$datos["email"],
        'foto' =>$rutaImg,
        'password' =>Hash::make($datos["password"])
       ]);
}else{

    DB::table('users')->where ('id', auth()->user()->id)
       ->update([

        'name'=>$datos['name'],
        'email' =>$datos['email'],
        'foto' =>$rutaImg,
        
       ]);
}
return redirect('Mis-Datos');

}


   
    public function index()
    {
        return view('modulos.users.Usuarios');
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
