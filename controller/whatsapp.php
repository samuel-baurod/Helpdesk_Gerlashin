<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Whatsapp.php");
    $whatsapp = new Whatsapp();

    //Opciones del controlador
    switch ($_GET["op"]){
        //Enviar ticket abierto con el ID
        case "w_ticket_abierto":
            $whatsapp->w_ticket_abierto($_POST["tick_id"]);
            break;

        case "w_ticket_cerrado":
            $whatsapp->w_ticket_cerrado($_POST["tick_id"]);
            break;
    
        case "w_ticket_asignado":
            $whatsapp->w_ticket_asignado($_POST["tick_id"]);
            break;
    }
?>