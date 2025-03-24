@extends ('welcome')

@section ('contenido')


    <div class="content-wrapper">

    <section class="content-header">

        <h1> Productos </h1>

    </section>


    <section class="content">

        <div class="box">

        <div class="box-header with-border">

        <button class= "btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto"> Agregar Productos </button>

        </div>

            <div class="box-body">

            <table class="table table-hover table-striped table-bordered dt-responsive">
                <thead>
                    <tr>
                        <th style="width:10px"> # </th>
                        <th> Imagen </th>
                        <th> Código </th>
                        <th> Descripción </th>
                        <th> Categoria </th>
                        <th> Stock </th>
                        <th> Agregado </th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($productos as $key =>   $producto) 

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                        @if ($producto->imagen == "" )
                            <img src="{{ asset('storage/users/perfildefault.png') }}" class="img-thumbnail" width="150px" height="150px">
                        @else
                            <img src="{{ asset('storage/'.$producto->imagen) }}" class="img-thumbnail" width="150px" height="150px">
                        @endif

                        </td>
                        <td>{{ $producto->codigo }}</td>
                        <td>{{ $producto->descripcion }}</td>

                        <td>{{ $producto->categoria_nombre }}</td>

                        <td>

                            @if ($producto->stock <= 10)
                                <span class="label label-danger"> {{ $producto->stock }} </span>
                            @elseif ($producto->stock <= 20)
                                <span class="label label-warning "> {{ $producto->stock }} </span>
                            @else
                                <span class="label label-success"> {{ $producto->stock }} </span>
                            @endif
 
                        </td>

                        <td>{{ $producto->agregado }}</td>
                       
                        <td>
                            <button class="btn btn-warning btnEditarProducto" idProducto="{{ $producto->id }}" data-toggle="modal" data-target="#modalEditarProducto"> <i class="fa fa-pencil"></i> </button>
                            <button class="btn btn-danger btnEliminarProducto" idProducto="{{ $producto->id }}"> <i class="fa fa-trash"></i> </button>
                        </td>
                        
                        </td>
                    </tr>
                    
                    @endforeach
                    

                </tbody>
            </table>

            </div>

            </div>

        </section>



</div>

<div class="modal fade" id="modalAgregarProducto">

    <div class="modal-dialog">

    <div class="modal-content">

    <form method="post" action="" enctype="multipart/form-data">
        @csrf

    <div class="modal-header"style="background:#3c8dbc; color:white">

        <button type=button class="close" data-dismiss="modal">
        &times;
        </button>

        <h4 class="modal-tittle">Agregar Productos</h4>

    </div>

    <div class="modal-body">
    <div class="box-body">
    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-th"> </i></span>

        <select name="id_categoria" id="selectCategoria" class="form-control input-lg" required>
            <option value="">Seleccionar categoria</option>

            @foreach($categorias as $categoria)

            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            
            @endforeach
        </select>
    </div>


    </div>

    <!-- Codigo -->

    <div class="form-group">

        <div class="input-group">

            <span class="input-group-addon"> <i class="fa fa-code"> </i></span>

            <input type="text" class="form-control input-lg" id="codigoProducto" name="codigo" readonly>

        </div>

    <!-- Descripcion del producto -->
    </div>

    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-product-hunt"> </i></span>

        <input type="text" class="form-control input-lg"  name="descripcion" required placeholder="Descripcion del producto">

    </div>


    </div>

    <!-- Stock -->
    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-check"> </i></span>

        <input type="number" min="0" class="form-control input-lg" name="stock" required placeholder="Stock del producto">

    </div>


    </div>


    <!-- Imagen -->

    <div class="form-group">

    <div class="input-group">
    
        <div class="panel">SUBIR IMAGEN</div>

        <input type="file"  name="imagen">
        <!-- <img src="{{ asset ('storage/app/public/productos/default.png') }}" class="img-thumbnail" width="100px"> -->
        <img src="{{ asset('storage/users/image.png') }}" width="80px" height="80px">
        

    </div>


    </div>
    
    </div>
    </div>

    <div class="modal-footer">

    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
    <button class="btn btn-primary" type="submit">Agregar Producto</button>

    </div>

    </form>

    </div>

</div>
</div>


<div class="modal fade" id="modalEditarProducto">

    <div class="modal-dialog">

    <div class="modal-content">

    <form method="post" action="Actualizar-Producto" enctype="multipart/form-data">
        @csrf
        @method('put')

    <div class="modal-header"style="background: #ffc107 ; color:black">

        <button type=button class="close" data-dismiss="modal">
        &times;
        </button>

        <h4 class="modal-title">Editar Productos</h4>

    </div>

    <div class="modal-body">
    <div class="box-body">
    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-th"> </i></span>

        <select name="id_categoria" id="selectCategoriaEditar" class="form-control input-lg" required>
            <option value="">Seleccionar categoria</option>

            @foreach($categorias as $categoria)

            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            
            @endforeach
        </select>
    </div>


    </div>

    <!-- Codigo -->

    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-code"> </i></span>

       
        <input type="hidden" class="form-control input-lg" id="idEditar" name="id" readonly>
        <input type="text" class="form-control input-lg" id="codigoProductoEditar" name="codigo" readonly>

    </div>

    <!-- Descripcion del producto -->
    </div>

    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-product-hunt"> </i></span>

        <input type="text" class="form-control input-lg" id="descripcionEditar" name="descripcion" required placeholder="Descripcion del producto">

    </div>


    </div>

    <!-- Stock -->
    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-check"> </i></span>

        <input type="number" min="0" class="form-control input-lg" id="stockEditar" name="stock" required placeholder="Stock del producto">

    </div>


    </div>


    <!-- Imagen -->

    <div class="form-group">

    <div class="input-group">
    
        <div class="panel">SUBIR IMAGEN</div>

        <input type="file"  name="imagen">
        
        <!-- <img src="{{ asset('storage/users/image.png') }}" width="150px" height="150px" id="imagenEditar"> -->
        <img src="{{ asset('storage/users/image.png') }}" class="img-thumbnail" width="150px" height="150px " tittle="equis">
        

    </div>


    </div>
    
    </div>
    </div>

    <div class="modal-footer">

    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
    <button class="btn btn-success" type="submit">Guardar Producto</button>

    </div>

    </form>

    </div>

</div>
</div>

<script>
    $(document).on('click', '.btnEditarCategoria', function() {
        var idCategoria = $(this).attr('idCategoria');
        var nombreCategoria = $(this).closest('tr').find('td:nth-child(2)').text();

        $('#idEditar').val(idCategoria);
        $('#nombreEditar').val(nombreCategoria);
        $('#nombreCategoriaModal').text(nombreCategoria);
    });
</script>




@endsection
