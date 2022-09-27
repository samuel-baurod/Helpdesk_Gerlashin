//Inicia la función
function init(){

}

$(document).ready(function(){
    var tick_id = getUrlParameter('ID');

    listardetalle(tick_id);

    $('#tickd_descrip').summernote({
        height: 400,
        lang: "es-ES",
        popover: {
            image: [],
            link: [],
            air: []
        },
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function(e) {
                console.log("Text detect...");
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    $('#tickd_descripusu').summernote({
        height: 400,
        lang: "es-ES",
        popover: {
            image: [],
            link: [],
            air: []
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    $('#tickd_descripusu').summernote('disable');

    tabla=$('#documentos_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
            ],
        "ajax":{
            url: '../../controller/documento.php?op=listar',
            type: "post",
            data: {tick_id: tick_id},
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        //Código de las tablas a generar cuando se liste el detalle de los tickets
        "bDestroy": true,
            "responsive": true,
            "bInfo": true,
            "iDisplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing":          "Procesando...",
                "sLengthMenu":          "Mostrar _MENU_ registros",
                "sZeroRecords":         "No se encontraron resultados",
                "sEmptyTable":          "Ningún dato disponible en esta tabla",
                "sInfo":                "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty":           "Mostrando un total de 0 registros",
                "sInfoFiltered":        "(filtrando de un total de _MAX_ registros)",
                "sInfoPostFix":         "",
                "sSearch":              "Buscar:",
                "sUrl":                 "",
                "sInfoThousands":       ",",
                "sLoadingRecords":      "Cargando...",
                "oPaginate": {
                    "sFirst":           "Primero",
                    "sLast":            "Último",
                    "sNext":            "Siguiente",
                    "sPrevious":        "Anterior"
                },
                "oAria": {
                    "sSortAscending":   ": Activar para la columna de manera ascendente",
                    "sSortDescending":  ": Activar para ordenar la columna de manera descendente"
                }
            }
        }).DataTable();
    });

var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for(i=0; i<sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');

        if(sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true: sParameterName[1];
        }
    }
};

$(document).on("click","#btnenviar",function(){
    //Declaración de variables
    var tick_id = getUrlParameter('ID');
    var usu_id = $('#user_idx').val();
    var tickd_descrip = $('#tickd_descrip').val();

    if($('#tickd_descrip').summernote('isEmpty')){
        //Llamado al sweetalert
        swal("¡Advertencia!", "Por favor, ingrese la descripción", "warning");
    } else{
        var formData = new FormData();
        formData.append('tick_id',tick_id);
        formData.append('usu_id',usu_id);
        formData.append('tickd_descrip',tickd_descrip);
        var totalfiles = $('#fileElem').val().length;
        for(var i=0; i < totalfiles; i++){
            formData.append("files[]",$('#fileElem')[0].files[i]);
        }

        $.ajax({
            url: "../../controller/ticket.php?op=insertdetalle",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);
                listardetalle(tick_id);
                /* TODO: Limpiar input file */
                $('#fileElem').val('');
                $('#tickd_descrip').summernote('reset');
                //Llamado al sweetalert
                swal("¡Correcto!", "Registrado Correctamente", "success");
            }
        });
    }
});

$(document).on("click","#btncerrarticket",function(){
    //Llamado al sweetalert
    swal({
        title: "¡Advertencia!",
        text: "¿Estás seguro/a de cerrar el ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            var tick_id = getUrlParameter('ID');
            var usu_id = $('#user_idx').val();

            //Llamado al controlador
            $.post("../../controller/ticket.php?op=update", { tick_id: tick_id, usu_id: usu_id}, function(data){
                
            });

            //Llamado al controlador
            $.post("../../controller/email.php?op=ticket_cerrado", {tick_id: tick_id}, function(data){
                    
            });

            //Llamado al controlador
            $.post("../../controller/whatsapp.php?op=w_ticket_cerrado", {tick_id: tick_id}, function(data){
                    
            });

            listardetalle(tick_id);
            //Llamado al sweetalert
            swal({
                title: "Ticket Cerrado",
                text: "El ticket se ha cerrado correctamente!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });
});

function listardetalle(tick_id){
    //Llamado al controlador
    $.post("../../controller/ticket.php?op=listardetalle", { tick_id: tick_id}, function(data){
        $('#lbldetalle').html(data);
    });

    //Llamado al controlador
    $.post("../../controller/ticket.php?op=mostrar", { tick_id: tick_id}, function(data){
        data = JSON.parse(data);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom +' '+data.usu_ape);
        $('#lblfechacreac').html(data.fecha_creac);

        $('#lblnomidticket').html("Detalle Ticket -"+data.tick_id);

        $('#cat_nom').val(data.cat_nom);
        $('#subcat_nom').val(data.subcat_nom);
        $('#tick_titulo').val(data.tick_titulo);
        $('#tickd_descripusu').summernote('code', data.tick_descrip);

        $('#priori_nom').val(data.priori_nom);

        if(data.tick_estado_texto=="Cerrado"){
            $('#pnldetalle').hide();
        }
    });

}

init();