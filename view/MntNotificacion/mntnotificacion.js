
$(document).ready(function(){

    var usu_id = $('#user_idx').val();

    tabla=$('#notificacion_data').dataTable({
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
                url: '../../controller/notificacion.php?op=listar',
                type: "post",
                dataType: "json",
                data: {usu_id: usu_id},
                error: function(e){
                    console.log(e.responseText);
                }
            },
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

function ver(tick_id){ //CAMBIAR LA RUTA DE LOCAL A PRODUCCIÓN
    //Local
    window.open('http://localhost:8081/Helpdesk_Gerlashin/view/DetalleTicket/?ID='+ tick_id +'');
    //Produccion
    //window.open('https://helpdesk-gerlashin.000webhostapp.com/view/DetalleTicket/?ID='+ tick_id +'');
}