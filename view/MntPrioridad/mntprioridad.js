//Se declara la variable necesaria
var tabla;

//Inicia la función
function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/prioridad.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            console.log(datos);
            $('#usuario_form')[0].reset();
            $('#modalmantenimiento').modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            swal({
                title: "Registro insertado",
                text: "El registro se ha insertado exitosamente!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).ready(function(){
    tabla=$('#usuario_data').dataTable({
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
                url: '../../controller/prioridad.php?op=listar',
                type: "post",
                dataType: "json",
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

function editar(priori_id){
    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/prioridad.php?op=mostrar", {priori_id: priori_id}, function(data){
        data = JSON.parse(data);
        $('#priori_id').val(data.priori_id);
        $('#priori_nom').val(data.priori_nom);
    });

    $('#modalmantenimiento').modal('show');
}

function eliminar(priori_id){
    swal({
        title: "¡Advertencia!",
        text: "¿Estás seguro/a de eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/prioridad.php?op=eliminar", {priori_id: priori_id}, function(data){
                
            });

            $('#usuario_data').DataTable().ajax.reload();

            swal({
                title: "Registro eliminado",
                text: "La prioridad se ha eliminado!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });
}

$(document).on("click","#btnnuevo", function(){
    $('#priori_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});

init();