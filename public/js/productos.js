//  $(".table").on("click", '.btnEditarCategoria', function (){

//     var Cid = $(this).attr("idCategoria");

//      $.ajax({
//          url: 'Editar-Categoria/'+Cid,
//          type:'GET',
//        success:function(respuesta){
//          $("#idEditar").val(respuesta["id"]);
//           $("#nombreEditar").val(respuesta["nombre"]);
//        }
//     })
// })
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

    tittle:'¿Estas seguro de eliminar la categoria : ' +categoria+ '?',
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

$("#selectCategoria").change(function(){

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
