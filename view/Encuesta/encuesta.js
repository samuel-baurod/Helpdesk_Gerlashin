//Inicia la función
function init(){
   
}

$(document).ready(function(){
    var tick_id = getUrlParameter('ID');
    listardetalle(tick_id);
    console.log(tick_id);

    $('#tick_evalstar').on('rating.change', function() {
        console.log($('#tick_evalstar').val());
    });

});

function listardetalle(tick_id){
    //Llamado al controlador
    $.post("../../controller/ticket.php?op=mostrar", { tick_id : tick_id }, function (data) {
        data = JSON.parse(data);
        $('#lblestado').val(data.tick_estado_texto);
        $('#lblnomusuario').val(data.usu_nom +' '+data.usu_ape);
        $('#lblfechacreac').val(data.fecha_creac);
        $('#lblnomidticket').val(data.tick_id);
        $('#cat_nom').val(data.cat_nom);
        $('#subcat_nom').val(data.subcat_nom);
        $('#tick_titulo').val(data.tick_titulo);
        $('#priori_nom').val(data.priori_nom);
        $('#lblfechacierre').val(data.fecha_cierre);

        if (data.tick_estado_texto=='Abierto') {
            window.open('http://localhost:8081/Helpdesk_Gerlashin/','_self');
        }else{
            if (data.tick_evalstar==null){

            }else{
                $('#panel1').hide();
            }
        }
    });
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).on("click","#btnguardar", function(){
    //Llamado de variables
    var tick_id = getUrlParameter('ID');
    var tick_evalstar = $('#tick_evalstar').val(); 
    var tick_comentstar = $('#tick_comentstar').val();

    //Llamado al controlador
    $.post("../../controller/ticket.php?op=encuesta", { tick_id : tick_id,tick_evalstar:tick_evalstar,tick_comentstar:tick_comentstar}, function (data) {
        console.log(data);
        $('#panel1').hide();
        //Llamado al sweetalert
        swal("¡Correcto!", "Gracias por su tiempo en contestar la encuesta.", "success");
    }); 
});