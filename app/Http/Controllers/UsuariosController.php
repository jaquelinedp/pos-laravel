<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursales;
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

        if(auth()->user()-> rol != 'Administrador'){
            return redirect ('Inicio');

        }
        $usuarios = User::all();
        $sucursales = Sucursales::where('estado', 1)->get(); 
        
        return view('modulos.users.Usuarios', compact('usuarios','sucursales'));
    }

  

    public function store(Request $request)
    {
        $validarEmail = request()->validate([
            'email' => 'unique:users'
        ]);
        $datos =request();

        if ($datos["rol"]!= 'Administrador'){
            $id_sucursal=0;
        }else{
            $id_sucursal=$datos["id_sucursal"];
        }

        User::create([
            'name' => $datos["name"],
            'email' => $validarEmail["email"],
            'id_sucursal'=>$id_sucursal,
            'foto'=>'',
            'password'=>Hash::make($datos["password"]),
            'estado'=>1,
            'ultimo_login'=>null,
            'rol'=>$datos["rol"]

        ]);

        return redirect('Usuarios')->with('success', 'El usuario ha sido creado correctamente');
        
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
