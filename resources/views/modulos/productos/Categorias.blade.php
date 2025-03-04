@extends ('welcome')

@section ('contenido')


    <div class="content-wrapper">

    <section class="content-header">

        <h1> Categorias </h1>

    </section>


    <section class="content">

        <div class="box">

        <div class="box-header with-border">

        <button class= "btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria"> Agregar Categoria</button>

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

                    @foreach ($categorias as $key => $categoria)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> {{ $categoria->nombre }} </td>

                            <td>
                            <button class="btn btn-warning btnEditarCategoria" idCategoria="{{ $categoria->id }}" data-toggle="modal" data-target="#modalEditarCategoria" tittle="Editar Categoria"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btnEliminarCategoria"  categoria="{{ $categoria->nombre }}" idCategoria="{{ $categoria->id }}" title="Eliminar Categoria"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            </div>

            </div>

        </section>



</div>

<div class="modal fade" id="modalAgregarCategoria">

    <div class="modal-dialog">

    <div class="modal-content">

    <form method="post" action="">
        @csrf

    <div class="modal-header"style="background:#3c8dbc; color:white">

        <button type=button class="close" data-dismiss="modal">
        &times;
        </button>

        <h4 class="modal-title">Agregar Categoria</h4>

    </div>

    <div class="modal-body">
    <div class="box-body">
    <div class="form-group">

    <div class="input-group">
    
        <span class="input-group-addon"> <i class="fa fa-th"> </i></span>

        <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar Nombre de la Categoria" required>

    </div>


    </div>
    </div>
    </div>

    <div class="modal-footer">

    <button class="btn btn-danger pull-left" type="button" data-dismiss="modal">Salir</button>
    <button class="btn btn-primary" type="submit">Agregar Categoria</button>

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
