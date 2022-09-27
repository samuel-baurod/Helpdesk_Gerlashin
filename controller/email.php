<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Email.php");
    $email = new Email();

    //Opciones del controlador
    switch ($_GET["op"]){
        //Enviar ticket abierto con el ID
        case "ticket_abierto":
            $email->ticket_abierto($_POST["tick_id"]);
            break;

        case "ticket_cerrado":
            $email->ticket_cerrado($_POST["tick_id"]);
            break;

        case "ticket_asignado":
            $email->ticket_asignado($_POST["tick_id"]);
            break;

        case "send_recuperar":
            $email->send_recuperar($_POST["usu_correo"]);
        break;
    }
?>