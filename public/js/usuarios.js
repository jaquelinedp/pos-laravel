$(".selectRol").change(function(){
    var Rol = $(this).val();

    if (Rol != 'Administrador') {
        $(".selectSucursal").show();
    }else{
        $(".selectSucursal").hide();
    }
})

$(".table").on('click', '.btnEstadoUser', function(){

       
        var Uid = $(this).attr('Uid');
        var estado = $(this).attr('estado');

        $.ajax({ 

            url: 'Cambiar-Estado-Usuario/'+Uid+'/'+estado,
            type: 'GET',
            success: function (){
                if (estado == 0){
                    $(this).removeClass('btn-success').addClass('btn-danger').attr('estado', 1).text('Desactivado');
                }else{
                    $(this).removeClass('btn-danger').addClass('btn-success').attr('estado', 0).text('Activado');
                }
                
            }.bind(this)

        }
    )
})

$(".table").on('click', '.btnEditarUsuario', function() {
  var Uid = $(this).attr('idUsuario');
     $.ajax({
         url: 'Editar-Usuario/' + Uid,
         type: 'GET',
         success: function(respuesta) {

             $('#nameEditar').val(respuesta.name);   
             $('#emailEditar').val(respuesta.email);
             $('#rolEditar').val(respuesta.rol);
             $('#idEditar').val(respuesta.id);
             

             if(respuesta.rol != 'Administrador'){

                $(".selectSucursal").show();
                $("#id_sucursalEditar").val(respuesta.id_sucursal); 

             }else{

                $(".selectSucursal").hide();

             }
        },
        
    
   });
});


// $("#emailEditar").change(function(){
//      var emailVerificar = $(this).val();
//     var idUser = $("#idEditar").val();

//     $.ajax({

//         url: 'Verificar-Usuario',
//         type: 'POST',
//         data: {email: emailVerificar, id: idUser},
//         success:function(respuesta){

//             // console.log(respuesta["emailVerificacion"]);
            
//             if(respuesta["emailVerificacion" ] == false){
//                  $("#emailEditar").parent().find('.alert').remove();
//                  $("#emailEditar").parent().after('<div class="alert alert-danger">Este email ya se encuentra registrado </div>');
//                  $("#emailEditar").val("");
//             }
//         }
//     });
// });

$("#emailEditar").change(function(){
    var emailVerificar = $(this).val();
    var idUser = $("#idEditar").val();

    $.ajax({
        url: 'Verificar-Usuario',
        method: 'POST',
        data: {
            email: emailVerificar,
            id: idUser,
            _token: $('meta[name="csrf-token"]').attr('content') // Agregar token CSRF
        },
        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);

            // Eliminar cualquier alerta previa antes de agregar una nueva
            $(".alert-danger").remove();
            
            if (respuesta["emailVerificacion"] === false) {
                $("#emailEditar").after('<div class="alert alert-danger">Este email ya se encuentra registrado</div>');
                $("#emailEditar").val("");
            }
        }
    });
});


$("#emailEditar").on("input", function() {
    $(".alert-danger").remove();
});

$(".table").on('click','.btnEliminarUsuario', function(){
    var Uid=$(this).attr('idUsuario');
    Swal.fire({

        tittle:'¿Estas seguro de eliminar este usuario?',
        text:'¡No podrás revertir esto!',
        icon:'warning',     
        showCancelButton:true,
        cancelButtonText:'Cancelar',
        cancelButtonColor:'#d33',
        confirmButtonText:'Si, eliminar usuario!',
        confirmButtonColor:'#3085d6'   

    }).then((result) => {

        if(result.isConfirmed){

            window.location = "Eliminar-Usuario/"+Uid;
        }
    })
})
