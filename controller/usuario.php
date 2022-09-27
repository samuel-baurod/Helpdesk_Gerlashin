<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    // op = operación
    switch($_GET["op"]){

        /* Controller para guardar y editar los datos del usuario */
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["usu_telf"]);
            }
            else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["usu_telf"]);
            }
        break;

        /* Controller para listar los datos del usuario */
        case "listar":
            $datos=$usuario->get_usuario();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_pass"];

                if ($row["rol_id"]=="1"){
                    $sub_array[] ='<span class="label label-pill label-info">Usuario</span>';
                } else{
                    $sub_array[] ='<span class="label label-pill label-secondary">Soporte</span>';
                }

                $sub_array[] = '<button type="button" onclick="editar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["usu_id"].');" id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        /* Controller para eliminar un usuario */
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
        break;

        /* Controller para mostrar los usuarios por su ID  */
        case "mostrar":
            $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["rol_id"] = $row["rol_id"];
                    $output["usu_telf"] = $row["usu_telf"];
                }
                echo json_encode($output);
            }
        break;

        /* Controller para comprobar el total de tickets */
        case "total":
            $datos = $usuario->get_usuario_total_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        /* Controller para comprobar el total de tickets abiertos */
        case "totalabierto":
            $datos = $usuario->get_usuario_totalabierto_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        /* Controller para comprobar el total de tickets cerrados  */
        case "totalcerrado":
            $datos = $usuario->get_usuario_totalcerrado_x_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        /* Controller para obtener los datos del usuario del grafico */
        case "grafico":
            $datos = $usuario->get_usuario_grafico($_POST["usu_id"]);
            echo json_encode($datos);
        break;

        /* Controller del combobox */
        case "combo":
            $datos = $usuario->get_usuario_x_rol();
            if(is_array($datos)==true and count($datos)>0){
                $html.="<option label='Seleccionar'></option>";
                foreach($datos as $row)
                {
                    $html.="<option value='".$row['usu_id']."'>".$row['usu_nom']."</option>";
                }
                echo $html;
            }
        break;

        /* Controller para actualizar contraseña */
        case "password":
            $usuario->update_usuario_pass($_POST["usu_id"],$_POST["usu_pass"]);
        break;

        /* Controller para actualizar contraseña desde login */
        case "logpassword":
            $usuario->lupdate_usuario_pass($_POST["usu_id"],$_POST["usu_pass"]);
            
        break;

        /* Controller para verificar que el correo esta en la BD en Recuperar contraseña*/
        case "correo":
            $datos = $usuario->get_correo_usuario($_POST["usu_correo"]);
            echo json_encode($datos);
        break;

        
    }
?>