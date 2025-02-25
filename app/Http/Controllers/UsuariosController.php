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
// public function ActualizarMisDatos(Request $request)
// {

//     if(auth()->user()->email != request('email')){

//         if(request('password')){

//             $datos = request()-> validate([

//                 'name'=>['required', 'string', 'max:50'],
//                 'email'=>['required',  'email', 'unique:users'],
//                 'password'=>['required', 'string', 'min:3']
                
//             ]);
//         }else{
//             $datos = request()-> validate([

//                 'name'=>['required', 'string', 'max:50'],
//                 'email'=>['required',  'email', 'unique:users']
              
                
//             ]);
//         }
//     }else{
//         if(request('password')){
//             $datos = request()-> validate([

//                 'name'=>['required', 'string', 'max:50'],
//                 'email'=>['required',  'email'],
//                 'password'=>['required', 'string', 'min:3']
                
//             ]);
//         }else{
//             $datos = request()-> validate([

//                 'name'=>['required', 'string', 'max:50'],
//                 'email'=>['required',  'email', 'unique:users']
              
                
//             ]);
//         }
//     }
//     if(request('fotoPerfil')){
//         if(auth()->user()->foto != ''){
//         $path =storage_path('app/public/'.auth()->user()->foto);
//         unlink($path);
//         }

//         $rutaImg = $request->file('fotoPerfil')->store('users', 'public');

//     }else{
//         $rutaImg = auth()->user()->foto;
//     }

//     if(isset($datos["password"])){

//        DB::table('users')->where ('id', auth()->user()->id)
//        ->update([

//         'name'=>$datos["name"],
//         'email' =>$datos["email"],
//         'foto' =>$rutaImg,
//         'password' =>Hash::make($datos["password"])
//        ]);
// }else{

//     DB::table('users')->where ('id', auth()->user()->id)
//        ->update([

//         'name'=>$datos['name'], 
//         'email' =>$datos['email'],
//         'foto' =>$rutaImg,
        
//        ]);
// }
// return redirect('Mis-Datos');

// }
public function ActualizarMisDatos(Request $request)
{
    $user = auth()->user(); // Usuario autenticado

    // Validar datos
    $rules = [
        'name' => ['required', 'string', 'max:50'],
    ];

    // Solo validar el email si se cambia
    if ($request->email !== $user->email) {
        $rules['email'] = ['required', 'email', 'unique:users,email,' . $user->id];
    } else {
        $rules['email'] = ['required', 'email'];
    }

    // Solo validar la contraseña si se proporciona
    if ($request->filled('password')) {
        $rules['password'] = ['required', 'string', 'min:3'];
    }

    $datos = $request->validate($rules);

    // Manejo de imagen
    if ($request->hasFile('fotoPerfil')) {
        // Eliminar la imagen anterior si existe
        if ($user->foto && file_exists(storage_path('app/public/' . $user->foto))) {
            unlink(storage_path('app/public/' . $user->foto));
        }

        // Guardar la nueva imagen
        $rutaImg = $request->file('fotoPerfil')->store('users', 'public');
    } else {
        $rutaImg = $user->foto;
    }

    // Actualizar datos en la base de datos
    $user->update([
        'name' => $datos['name'],
        'email' => $datos['email'],
        'foto' => $rutaImg,
        'password' => isset($datos['password']) ? Hash::make($datos['password']) : $user->password,
    ]);

    return redirect('Mis-Datos')->with('success', 'Perfil actualizado correctamente');
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

        if ($datos["rol"] == 'Administrador'){
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

   
    public function CambiarEstado($id_usuario, $estado)
    {
        User::find ($id_usuario)->update(['estado'=>$estado]);
    }

    
    public function edit($id_usuario)
    {
        $usuario = User::find($id_usuario);
        return response ()->json($usuario); 
    }


    // public function VerificarUsuario (Request $request)
    // {
    //     $user = User::find($request->id);
        
    //     if($request->email != $user ["email"]){

    //         $emailExistente = User::where('email', $request -> email)->exists();

    //         if($emailExistente!= null){
    //             $verificacion = false;
    //         }else{
    //             $verificacion=true;
    //         }
    //     }else{  
    //         $verificacion = true;
    //     }

    //     return response()->json(['emailVerificacion'=>$verificacion]);
    // }

    public function VerificarUsuario (Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'id' => 'required|integer',
    ]);

    $user = User::find($request->id);
    if (!$user) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    if ($request->email != $user->email) {
        $emailExistente = User::where('email', $request->email)->exists();
        $verificacion = !$emailExistente;
    } else {  
        $verificacion = true;
    }

    return response()->json(['emailVerificacion' => $verificacion]);
}


    public function update(Request $request)
    {
        if(request('password')){
            $validarPass=request()->validate([
                    'password'=>["string","min:3"]
                ]);
                $pass=true;
        }else{
                $pass=false;
        }

        

        $datos=request();
        
        if($datos["rol"]=='Administrador'){
            $id_sucursal=0;
        }else{
            $id_sucursal=$datos["id_sucursal"];
        }

        $User=User::find($datos["id"]);

        $User->name=$datos["name"];
        $User->email=$datos["email"];
        $User->id_sucursal=$id_sucursal;
        $User->rol=$datos["rol"];

        if($pass != false){
            $User->password = Hash::make($datos["password"]);
        }
        $User->save();
        return redirect('Usuarios')->with('success','El usuario ha sido actualizado correctamente');
    }

        public function destroy($id_usuario)
    {
        $usuario = User::find($id_usuario);

        if($usuario->foto != ''){
            $path = storage_path('app/public'. $usuario->foto);
            unlink($path);
        }

        User::destroy($id_usuario);

        return redirect ('Usuarios');
    }
}
