<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Prioridad.php");
    $prioridad = new Prioridad();

    switch($_GET["op"]){

        /* Controller para guardar y editar los datos del usuario */
        case "guardaryeditar":
            if(empty($_POST["priori_id"])){
                $prioridad->insert_prioridad($_POST["priori_nom"]);
            }
            else{
                $prioridad->update_prioridad($_POST["priori_id"],$_POST["priori_nom"]);
            }
            break;

        /* Controller para listar los datos del usuario */
        case "listar":
            $datos=$prioridad->get_prioridad();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["priori_nom"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["priori_id"].');" id="'.$row["priori_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["priori_id"].');" id="'.$row["priori_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
            $prioridad->delete_prioridad($_POST["priori_id"]);
            break;

        /* Controller para mostrar los usuarios por su ID  */
        case "mostrar":
            $datos = $prioridad->get_prioridad_x_id($_POST["priori_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["priori_id"] = $row["priori_id"];
                    $output["priori_nom"] = $row["priori_nom"];
                }
                echo json_encode($output);
            }
            break;

        case "combo":
            $datos = $prioridad->get_prioridad();
            $html="";
            $html.="<option label='Seleccionar...'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['priori_id']."'>".$row['priori_nom']."</option>"; 
                }
                echo $html;
            }
            break;
    }
?>