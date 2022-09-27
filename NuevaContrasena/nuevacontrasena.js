
$(document).on("click","#btnlactualizar", function(){
    var passlog = $("#txtpasslog").val();
    var newpasslog = $("#txtpassnewlog").val();

    if(passlog.length == 0 || newpasslog.length == 0){
        swal("¡Error!", "Campos vacíos", "error");
    } else{
        if(passlog==newpasslog){

            $.post("../controller/usuario.php?op=logpassword", {usu_pass: newpasslog}, function(data){
                  
                swal("¡Contraseña actualizada!", "Ahora podrás iniciar sesión en el sistema", "success");
                console.log(data);
                $('#txtpasslog').val('');
                $('#txtpassnewlog').val('');
                
            });
        }else{
            swal("¡Error!", "Las contraseñas no coinciden", "error");
        }
    }
});
