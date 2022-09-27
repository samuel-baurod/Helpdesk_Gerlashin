<?php

/* llamada de las clases necesarias que se usaran en el envio del mail*/
require_once("../config/conexion.php");
require_once("../models/Ticket.php");

class Whatsapp extends Conectar{

    public function w_ticket_abierto($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        //Llamada a la API de Chat API - WhatsApp
        $apiURL = 'https://api.chat-api.com/instance424467/';
        $token = '1g628o3hzssnae1j';

        $data = json_encode(
            array(
                'chatId'=>"".$telefono."@c.us",
                'body'=>"Ticket Abierto ".$id." : ".$titulo.""
            )
        );

        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        echo $response; exit;
    }

    public function w_ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        $apiURL = 'https://api.chat-api.com/instance424467/';
        $token = '1g628o3hzssnae1j';

        $data = json_encode(
            array(
                'chatId'=>"".$telefono."@c.us",
                'body'=>"Ticket Cerrado ".$id." : ".$titulo.""
            )
        );

        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        echo $response; exit;
    }

    public function w_ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        $apiURL = 'https://api.chat-api.com/instance424467/';
        $token = '1g628o3hzssnae1j';

        $data = json_encode(
            array(
                'chatId'=>"".$telefono."@c.us",
                'body'=>"Ticket Asignado ".$id." : ".$titulo.""
            )
        );

        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        echo $response; exit;
    }

}

?>