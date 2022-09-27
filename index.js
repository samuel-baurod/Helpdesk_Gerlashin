//Inicia la función
function init(){
}

$(document).ready(function() {
    
});

//Acciones de acuerdo al rol, 1 = usuario, 2 = soporte
$(document).on("click", "#btnsoporte", function(){

    if($('#rol_id').val()==1){
        $('#lbltitulo').html("Acceso Soporte");
        $('#btnsoporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $('#imgtipo').attr("src","public/2.png");
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $('#imgtipo').attr("src","public/1.png");
    }
});

init();