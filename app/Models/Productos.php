<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
  protected $table = 'productos';

  protected $fillable = [
    'id_categoria',
    'codigo',
    'descripcion',
    'stock',
    'imagen',
    'agregado',
    'ventas'
  ];

  public $timestamps = false; 
}
