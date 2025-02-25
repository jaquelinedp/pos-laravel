@extends ('welcome')
@section ('contenido')
<div class="content-wrapper">
   <section class="content-header">
      <h1> Gestor de usuarios  </h1>
   </section>
   <section class="content">
      <div class="box">
         <div class="box-header with-border">
            <button class= "btn btn-primary" data-toggle="modal" data-target="#modalCrearUsuario" >Crear usuario</button>
         </div>
         <div class="box-body">
            <table class="table table-bordered table-striped table-hover dt-responsive " >
               <thead>
                  <tr>
                     <th style="width: 10px;" > No. </th>
                     <th>Nombre</th>
                     <th>Email</th>
                     <th>Foto</th>
                     <th>Sucursal</th>
                     <th>Rol</th>
                     <th>Estado</th>
                     <th>Ultimo login</th>
                     <th>      </th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ( $usuarios as $key => $user )
                  <tr>
                     <td>{{ $key+1 }}</td>
                     <td>{{$user->name}}</td>
                     <td>{{$user->email}}</td>
                     <td>
                        @if($user->foto != '')
                        <img src="{{url('storage/' .$user ->foto)}}" class="img-thumbnail" width="50px">
                        @else
                        <img src="{{url('storage/users/anonymous.jpg')}}" class="img-thumbnail" width="40px"> 
                        
                        <p class="text-muted">Sin foto</p>
                        @endif
                     </td>
                     <td>
                        @if($user->rol !='Administrador')
                        {{ $user->SUCURSAL->nombre}}
                        @endif
                     </td>
                     <td>{{$user->rol}}</td>
                     <td>
                        @if ($user->estado == 1)
                        <button class="btn btn-success btn-xs btnEstadoUser" Uid="{{$user->id}}" estado="0" >Activado</button>
                        @else
                        <button class="btn btn-danger btn-xs btnEstadoUser" Uid="{{$user->id}}" estado="1" >Desactivado</button>
                        @endif
                     </td>
                     <td>{{$user->ultimo_login}}</td>
                     <td>
                        <!-- <button  class="btn btn-warning btnEditarUsuario" idUsuario="{{ $user->id  }}" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button> -->
                        <button class="btn btn-warning btnEditarUsuario" idUsuario="{{ $user->id  }}" data-toggle="modal" data-target="#modalEditarUsuario" title="Editar usuario"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="{{ $user->id  }}"  ><i class="fa fa-trash"></i></button>
                        
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </section>
</div>
    <div class="modal fade" id="modalCrearUsuario">
    <div class="modal-dialog">
    <div class="modal-content">
        <form method="post" action="">
            @csrf
           
            <div class="modal-header"style="background:#3c8dbc; color:white">
                <button type=button class="close" data-dismiss="modal">
                &times;
                </button>
                <h4 class="modal-title">Crear Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-user"> </i></span>
                        <input type="text" class="form-control input-lg" name="name" placeholder="Ingresar Nombre " required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control input-lg" name="email" placeholder="Ingresar email " required>
                    </div>
                    @error('email')
                    <p class="alert alert-danger">El email ya se encuentra registrado</p>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-lock "> </i></span>
                        <input type="password" class="form-control input-lg" name="password" placeholder="Ingresar contraseña " required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-users"> </i></span>
                        <select class="form-control input-lg selectRol" name="rol">
                            <option value="">Seleccionar rol</option>
                            <option value="Administrador">Administrador</option>
                            <!-- <option value="Recursos humanos">Recursos humanos</option>
                            <option value="Finanzas">Finanzas</option> -->
                            <option value="Encargado">Encargado</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group selectSucursal" style="display:none">
                    <div class="input-group">
                        <span class="input-group-addon"> <i class="fa fa-building"> </i></span>
                        <select class="form-control input-lg" name="id_sucursal">
                            <option value="">Seleccionar sucursal </option>
                            @foreach ($sucursales as $sucursal )
                            <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
                <button class="btn btn-primary" type="submit">Crear usuario</button>
            </div>
        </form>
    </div>
</div>
</div>

 

            <div class="modal fade" id="modalEditarUsuario">
                <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ url('Actualizar-Usuario') }}">
                        @csrf
                        @method('put');
                        <div class="modal-header"style="background:#eb984e; color:black">
                            <button type=button class="close" data-dismiss="modal">
                            &times;
                            </button>
                            <!-- <h4 class="modal-title">Editar Usuario</h4> -->
                            <h4 class="modal-title">Editar Usuario: <span id="nombreUsuarioModal"></span></h4>

                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-user"> </i></span>
                                    <input type="text" class="form-control input-lg" id="nameEditar" name="name" placeholder="Nuevo nombre " required>
                                    <input type="hidden" class="form-control input-lg" id="idEditar" name="id" placeholder="Nuevo id " required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control input-lg" id="emailEditar" name="email" placeholder="Nuevo email " required>
                                </div>
                                @error('email')
                                <p class="alert alert-danger">El email ya se encuentra registrado</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-lock "> </i></span>
                                    <input type="password" class="form-control input-lg" id="passwordEditar" name="password" placeholder="Nueva contraseña " >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-users"> </i></span>
                                    <select class="form-control input-lg selectRol" name="rol" id="rolEditar">
                                        <option value="">Selecciona el nuevo rol</option>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Encargado">Encargado</option>
                                        <option value="Vendedor">Vendedor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group selectSucursal" style="display:none">
                                <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-building"> </i></span>
                                    <select class="form-control input-lg" name="id_sucursal" id="id_sucursalEditar">
                                        <option value="">Seleccionar sucursal </option>
                                        @foreach ($sucursales as $sucursal )
                                        <option value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success" type="submit">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection