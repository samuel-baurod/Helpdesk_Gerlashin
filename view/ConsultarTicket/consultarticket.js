//Se declaran las variables requeridas
var tabla;
var usu_id = $('#user_idx').val();
var rol_id = $('#rol_idx').val();

//Inicia la función
function init(){
    $("#ticket_form").on("submit",function(e){
        guardar(e);
    });
}

$(document).ready(function(){

    $.post("../../controller/categoria.php?op=combo",function(data, status){
        $('#cat_id').html(data);
    });

    $.post("../../controller/prioridad.php?op=combo",function(data, status){
        $('#priori_id').html(data);
    });

    $.post("../../controller/usuario.php?op=combo", function(data){
        $('#usu_asig').html(data);
    });

    /* TODO: Rol si es 1 entonces es usuario */
    //Código de la sección de descargar reportes con distintos formatos
    if(rol_id==1){

        $('#viewuser').hide();

        tabla=$('#ticket_data').dataTable({ 
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
                url: '../../controller/ticket.php?op=listar_x_usu',
                type: "post",
                dataType: "json",
                data:{ usu_id: usu_id},
                error: function(e){
                    console.log(e.responseText);
                }
            },
            //Código de las tablas a generar cuando se listen los tickets por usuario
            "ordering": false,
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
    }else{
        var tick_titulo = $('#tick_titulo').val();
        var cat_id = $('#cat_id').val();
        var priori_id = $('#priori_id').val();
        
        listardatatable(tick_titulo,cat_id,priori_id);
    }
    
});

function ver(tick_id){ //CAMBIAR LA RUTA DE LOCAL A PRODUCCIÓN
    //Local
    window.open('http://localhost:8081/Helpdesk_Gerlashin/view/DetalleTicket/?ID='+ tick_id +'');
    //Produccion
    //window.open('https://helpdesk-gerlashin.000webhostapp.com/view/DetalleTicket/?ID='+ tick_id +'');
}

function asignar(tick_id){
    $.post("../../controller/ticket.php?op=mostrar", {tick_id: tick_id}, function(data){
        data = JSON.parse(data);
        $('#tick_id').val(data.tick_id);
        $("#mdltitulo").html('Asignar Personal de Soporte');  
        $("#modalasignar").modal('show');  
    });
    
}

function guardar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    $.ajax({
        url: "../../controller/ticket.php?op=asignar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            var tick_id = $('#tick_id').val();
            $.post("../../controller/email.php?op=ticket_asignado", {tick_id: tick_id}, function(data){
                    
            });

            $.post("../../controller/whatsapp.php?op=w_ticket_asignado", {tick_id: tick_id}, function(data){
                    
            });
            //Llamado al sweetalert
            swal("¡Correcto!", "Asignado Correctamente", "success");
            $("#modalasignar").modal('hide');
            $('#ticket_data').DataTable().ajax.reload();
        }
    });
}

function CambiarEdoTicket(tick_id){
    //Llamado al sweetalert
    swal({
        title: "¡Advertencia!",
        text: "¿Estás seguro/a de reabrir el ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/ticket.php?op=reabrir", {tick_id: tick_id, usu_id: usu_id}, function(data){
                
            });

            $('#ticket_data').DataTable().ajax.reload();
            //Llamado al sweetalert
            swal({
                title: "Ticket Abierto",
                text: "El ticket se ha abierto!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    }); 
}


$(document).on("click","#btnfiltrar",function(){
    limpiar();

    var tick_titulo = $('#tick_titulo').val();
    var cat_id = $('#cat_id').val();
    var priori_id = $('#priori_id').val();

    listardatatable(tick_titulo,cat_id,priori_id);

});

$(document).on("click","#btntodo",function(){
    limpiar();

    $('#tick_titulo').val('');
    $('#cat_id').val('').trigger('change');
    $('#priori_id').val('').trigger('change');

    listardatatable('','','');
});

function listardatatable(tick_titulo,cat_id,priori_id){
    //Código de la sección de descargar reportes con distintos formatos
    tabla=$('#ticket_data').dataTable({
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
            url: '../../controller/ticket.php?op=listar_filtro',
            type: "post",
            dataType: "json",
            data:{ tick_titulo: tick_titulo, cat_id: cat_id, priori_id: priori_id},
            error: function(e){
                console.log(e.responseText);
            }
        },
        //Código de las tablas a generar cuando se listen los tickets
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
}

function limpiar(){
    $('#table').html(
        "<table id='ticket_data' class='table table-bordered table-striped table-vcenter js-dataTable-full'>"+
            "<thead>"+
                "<tr>"+
                    "<th style='width: 5%;'>No. Ticket</th>"+
                    "<th style='width: 15%;'>Categoria</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 30%;'>Titulo</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 5%;'>Prioridad</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 5%;'>Estado</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha Creación</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha Asignación</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 10%;'>Fecha Cierre</th>"+
                    "<th class='d-none d-sm-table-cell' style='width: 10%;'>Soporte</th>"+
                    "<th class='text-center' style='width: 5%;'>Ver</th>"+
                "</tr>"+
            "</thead>"+
            "<tbody>"+

            "</tbody>"+
        "</table>"
    );
}

init();