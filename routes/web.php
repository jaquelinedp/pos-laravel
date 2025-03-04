<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Facade;

Route::get('/', function () {
    return view('modulos.users.Ingresar');
})->name('Ingresar');

Route::get('Inicio', function () {
    return view('modulos.Inicio');
});


Route::get('Primer-Usuario', [UsuariosController::class, 'PrimerUsuario']);

Auth::routes();


//Sucursales

Route::get('Sucursales', [SucursalesController::class, 'index']);
Route::post('Sucursales', [SucursalesController::class, 'store']);
Route::get('Editar-Sucursal/{id_sucursal}', [SucursalesController::class,'edit']);
Route::put('Actualizar-Sucursal', [SucursalesController::class, 'update']);
Route::get('Cambiar-Estado-Sucursal/{estado}/{id_sucursal}', [SucursalesController::class,'CambiarEstado']);

//Usuarios

Route::get('Mis-Datos', function(){

    return view ('modulos.users.Mis-Datos');
});

Route::post('Mis-Datos', [UsuariosController::class, 'ActualizarMisDatos']);
Route::get('Usuarios', [UsuariosController::class,'index']);
Route::post('Usuarios', [UsuariosController::class, 'store']);
Route::get('Cambiar-Estado-Usuario/{id_usuario}/{estado}',[UsuariosController::class,'CambiarEstado']);
Route::get('Editar-Usuario/{id_usuario}', [UsuariosController::class, 'edit']);
// Route::post('Verificar-Usuario', [UsuariosController::class,'VerificarUsuario']);
Route::post('Verificar-Usuario', [UsuariosController::class,'VerificarUsuario']);
Route::put('Actualizar-Usuario',[UsuariosController::class, 'update']);
Route::get('Eliminar-Usuario/{id_usuario}',[UsuariosController::class, 'destroy']);

//Categorias

Route::get('Categorias',[CategoriasController::class, 'index']);
Route::post('Categorias',[CategoriasController::class,'store']);
Route::get('Editar-Categoria/{id_categoria}', [CategoriasController::class, 'edit']);
Route::put('Actualizar-Categoria', [CategoriasController::class, 'update']);
Route::get('Eliminar-Categoria/{id_categoria}', [CategoriasController::class, 'destroy']);

//Productos
Route::get('Productos', [ProductosController::class, 'index']);
Route::get('Generar-Codigo-Producto/{id_categoria}', [ProductosController::class, 'GenerarCodigo']);
