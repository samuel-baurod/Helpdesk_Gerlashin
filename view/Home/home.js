//Inicio de la función
function init(){

}

$(document).ready(function(){
    //Llamado a la variable usu_id
    var usu_id = $('#user_idx').val();

    if($('#rol_idx').val()==1){
        //Llamado al controlador
        $.post("../../controller/usuario.php?op=total", { usu_id: usu_id}, function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
    
        //Llamado al controlador
        $.post("../../controller/usuario.php?op=totalabierto", { usu_id: usu_id}, function(data){
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        //Llamado al controlador
        $.post("../../controller/usuario.php?op=totalcerrado", { usu_id: usu_id}, function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        //Llamado al controlador
        $.post("../../controller/usuario.php?op=grafico", { usu_id: usu_id}, function(data){
            data = JSON.parse(data);
            
            //Morris, genera los graficos de barras del menu principal
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Cantidad'],
                barColors: ["#154360"],
            });
        });


    } else{
        //Llamado al controlador
        $.post("../../controller/ticket.php?op=total", function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
    
        //Llamado al controlador
        $.post("../../controller/ticket.php?op=totalabierto", function(data){
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        //Llamado al controlador
        $.post("../../controller/ticket.php?op=totalcerrado", function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        //Llamado al controlador
        $.post("../../controller/ticket.php?op=grafico", function(data){
            data = JSON.parse(data);
            
            //Morris, genera los graficos de barras del menu principal
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Cantidad'],
                barColors: ["#154360"],
            });
        });
    }

    
});

init();