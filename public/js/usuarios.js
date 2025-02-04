$(".selectRol").change(function(){
    var Rol = $(this).val();

    if (Rol != 'Administrador') {
        $(".selectSucursal").show();
    }else{
        $(".selectSucursal").hide();
    }
})