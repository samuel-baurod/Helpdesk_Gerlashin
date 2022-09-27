function init(){
    
}

$(document).ready(function() {
    
});

$(document).on("click","#btnrecuperar", function(){

    var usu_correo = $('#usu_correo').val();

    if(usu_correo ==""){

        Swal.fire(
            '¡Error!',
            'Campos de texto vacios',
            'error'
        );

    } else { 
        $.post("../controller/usuario.php?op=correo", { usu_correo : usu_correo}, function(data){
            if (data=='[]'){
                Swal.fire(
                    '¡Error!',
                    'Usuario no registrado en el sistema',
                    'error'
                );
            }else{
                $.post("../controller/email.php?op=send_recuperar", { usu_correo : usu_correo}, function(data){
                    console.log(data) 
                    $('#usu_correo').val('');
                });

                Swal.fire(
                    '¡Correcto!',
                    'Se ha enviado mensaje al correo registrado.',
                    'success'
                );
            }
        });
    } 

});

init();