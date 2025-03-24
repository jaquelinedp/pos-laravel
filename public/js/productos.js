
$(".table").on("click", ".btnEditarCategoria", function () {
     var Cid = $(this).attr("idCategoria");

     $.ajax({
         url: 'Editar-Categoria/' + Cid,
         type: 'GET',
         success: function (respuesta) {
             console.log("Respuesta del servidor:", respuesta);

             // Llenar los campos del modal con los datos obtenidos
             $("#idEditar").val(respuesta.id);
             $("#nombreEditar").val(respuesta.nombre);
            
             // Mostrar el modal
             $("#modalEditarCategoria").modal("show");
         },
         error: function (xhr, status, error) {
           console.error("Error en la solicitud AJAX:", error);
       }
     });
});

$('.table').on('click', '.btnEliminarCategoria', function () {
  var Cid = $(this).attr("idCategoria");
  var categoria = $(this).attr("categoria");

  Swal.fire({

    title:'¿Estas seguro de eliminar la categoria : ' +categoria+ '?',
    text:'¡No podrás revertir esto!',
    icon:'warning',     
    showCancelButton:true,
    cancelButtonText:'Cancelar',
    cancelButtonColor:'#d33',
    confirmButtonText:'Si, eliminar categoria!',
    confirmButtonColor:'#3085d6'   

}).then((result) => {

    if(result.isConfirmed){

        window.location = "Eliminar-Categoria/"+Cid;
    }
})
})

$("#selectCategoria", ).change(function(){

    var idCategoria = $(this).val();

    $.ajax({
        url: 'Generar-Codigo-Producto/'+idCategoria,
        type: 'GET',
        success:function(respuesta){
            if (respuesta == 0 ){
                var nuevoCodigo = idCategoria+"01";
            }else{
                var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            }
            $("#codigoProducto").val(nuevoCodigo);
        }
    })
})


$(".table").on("click", ".btnEditarProducto", function () {

    var Pid = $(this).attr("idProducto");

    $.ajax({

        url: 'Editar-Producto/' + Pid,
        type: 'GET',
        success: function (respuesta){
            console.log(respuesta); // Verifica qué datos devuelve la API
            $("#idEditar").val(respuesta.id); 
            $("#selectCategoriaEditar").val(respuesta.id_categoria);
            $("#codigoProductoEditar").val(respuesta.codigo);
            $("#descripcionEditar").val(respuesta.descripcion);
            $("#stockEditar").val(respuesta.stock );

            if(respuesta.imagen != " "){
                $("#imagenEditar").attr('src','storage/'+ respuesta.imagen);
            }else{
                $("#imagenEditar").attr('src', 'storage/app/public/plantilla/danonenara.png');

                
            }
            
        }
    })

});



$("#selectCategoriaEditar", ).change(function(){

    var idCategoria = $(this).val();

    $.ajax({
        url: 'Generar-Codigo-Producto/'+idCategoria,
        type: 'GET',
        success:function(respuesta){
            if (respuesta == 0 ){
                var nuevoCodigo = idCategoria+"01";
            }else{
                var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            }
            $("#codigoProductoEditar").val(nuevoCodigo);
        }
    })
})


$(".table").on("click", ".btnEditarProducto", function () {

    var Pid = $(this).attr("idProducto");

    $.ajax({

        url: 'Editar-Producto/' + Pid,
        type: 'GET',
        success: function (respuesta){
            console.log(respuesta); // Verifica qué datos devuelve la API
            $("#idEditar").val(respuesta.id); 
            $("#selectCategoriaEditar").val(respuesta.id_categoria);
            $("#codigoProductoEditar").val(respuesta.codigo);
            $("#descripcionEditar").val(respuesta.descripcion);
            $("#stockEditar").val(respuesta.stock );

            if(respuesta.imagen != " "){
                $("#imagenEditar").attr('src','storage/'+ respuesta.imagen);
            }else{
                $("#imagenEditar").attr('src', 'storage/app/public/plantilla/danonenara.png');

                
            }
            
        }
    })

});


$('.table').on('click', '.btnEliminarProducto', function () {
    var Pid = $(this).attr("idProducto");
    var producto = $(this).attr("producto");
  
    Swal.fire({
  
      title:'¿Estas seguro de eliminar este producto?',
      text:'¡No podrás revertir esto!',
      icon:'warning',     
      showCancelButton:true,
      cancelButtonText:'Cancelar',
      cancelButtonColor:'#d33',
      confirmButtonText:'Si, eliminar el producto!',
      confirmButtonColor:'#3085d6'   
  
  }).then((result) => {
  
      if(result.isConfirmed){
  
          window.location = "Eliminar-Producto/"+Pid;
      }
  })
  })
