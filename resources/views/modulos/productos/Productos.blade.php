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
                        <th> Categorias </th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <tbody>

                    

                </tbody>
            </table>

            </div>

            </div>

        </section>



</div>

<div class="modal fade" id="modalAgregarProducto">

    <div class="modal-dialog">

    <div class="modal-content">

    <form method="post" action="">
        @csrf

    <div class="modal-header"style="background:#3c8dbc; color:white">

        <button type=button class="close" data-dismiss="modal">
        &times;
        </button>

        <h4 class="modal-title">Agregar Productos</h4>

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


    
    <!-- Precios *borrar*-->
    <div class="form-group row">

        <div class="col-xs-6">

        <div class="input-group">
        
                <span class="input-group-addon"> <i class="fa fa-arrow-up"> </i></span>

                <input type="number" class="form-control input-lg"  name="precio_compra" min="0" required placeholder="Precio de compra">

            </div>

        </div>

        <div class="col-xs-6">

        <div class="input-group">
        
                <span class="input-group-addon"> <i class="fa fa-arrow-down"> </i></span>

                <input type="number" class="form-control input-lg"  name="precio_venta" min="0" required placeholder="Precio de venta">

            </div>

        

        <br>

        <div class="col-xs-6">

        <div class="input-group">

        <label>
        <input type="checkbox" class="minimal porcentaje" >
        </label>
        </div>
        </div>

        <div class="col-xs-6" style="padding:0">

        <div class="input-group">

                <input type="number" class="form-control input-lg"  name="precio_compra" min="0" required value="40">

                <span class="input-group-addon"> <i class="fa fa-percent"> </i></span>

            </div>

        </div>

        </div>

    </div>

    <!-- Imagen -->

    <div class="form-group">

    <div class="input-group">
    
        <div class="panel">SUBIR IMAGEN</div>

        <input type="file"  name="imagen">
        <!-- <img src="{{ asset ('storage/app/public/productos/default.png') }}" class="img-thumbnail" width="100px"> -->
        <img src="{{ asset('storage/users/image.png') }}" width="150px" height="150px">
        

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



<div class="modal fade" id="modalEditarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ url('Actualizar-Categoria') }}">
                @csrf
                @method('put')

                <div class="modal-header" style="background:#ddc175; color:black">
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title">Editar Categoria: <span id="nombreCategoriaModal"></span></h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-th"> </i></span>
                                <input type="text" class="form-control input-lg" id="nombreEditar" name="nombre" placeholder="Ingresar Nombre de la Categoria" required>
                                <input type="hidden" class="form-control input-lg" id="idEditar" name="id" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-warning" type="submit">Guardar Categoria</button>
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
