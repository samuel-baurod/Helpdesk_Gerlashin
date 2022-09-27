<?php

/* librerias necesarias para que el proyecto pueda enviar emails */
require('class.phpmailer.php');
include('class.smtp.php');

/* llamada de las clases necesarias que se usaran en el envio del mail*/
require_once("../config/conexion.php");
require_once("../models/Ticket.php");
require_once("../models/Usuario.php");

class Email extends PHPMailer{
    protected $gcorreo = 'soporte.gerlashinmx@outlook.com'; //Variable que contiene el correo del destinatario
    protected $gpass = 'GHDsoporte.mx'; //Variable que contiene la contraseña del destinatario

    public function ticket_abierto($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        //Igual para todo correo
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com'; //Aqui el server
        $this->Port = 587; //Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName = $this->tu_nombre = "Ticket Abierto ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Ticket Abierto";
        //Igual para todo correo
        
        $cuerpo = file_get_contents("../public/NuevoTicket.html"); //Ruta en formato html

        //Parametros a reemplazar
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCateg", $categoria, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Abierto");
        return $this->Send();
    }

    public function ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        //Igual para todo correo
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com'; //Aqui el server
        $this->Port = 587; //Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName = $this->tu_nombre = "Ticket Cerrado ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Ticket Cerrado";
        //Igual para todo correo
        
        $cuerpo = file_get_contents("../public/CerradoTicket.html"); //Ruta en formato html

        //Parametros a reemplazar
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCateg", $categoria, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Cerrado");
        return $this->Send();
    }

    public function ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        //Igual para todo correo
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com'; //Aqui el server
        $this->Port = 587; //Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName = $this->tu_nombre = "Ticket Asignado ".$id;
        $this->CharSet = 'UTF8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Ticket Asignado";
        //Igual para todo correo
        
        $cuerpo = file_get_contents("../public/AsignarTicket.html"); //Ruta en formato html

        //Parametros a reemplazar
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCateg", $categoria, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Asignado");
        return $this->Send();
    }

    
    public function send_recuperar($usu_correo){
        $usuario = new Usuario();
        $datos = $usuario->get_correo_usuario($usu_correo);
        foreach ($datos as $row) {
            $idusu = $row["usu_id"];
            $correo = $row["usu_correo"];
            $usu = $row["usu_nom"].' '.$row["usu_ape"];
        }

        //Igual para todo correo
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com'; //Aqui el server
        $this->Port = 587; //Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'tls';
        $this->FromName = $this->tu_nombre = "Recuperar Contraseña ";
        $this->CharSet = 'UTF8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Recuperar Contraseña";
        //Igual para todo correo

        $cuerpo = file_get_contents('../public/RecuperarContrasena.html');
        
         //Parametros a reemplazar
         $cuerpo = str_replace("xnrousuid", $idusu, $cuerpo);
         $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
       
        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Recuperar Contraseña");
        return $this->Send();
    }
    
}

?>