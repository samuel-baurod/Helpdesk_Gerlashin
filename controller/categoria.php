<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    // op = operación
    switch($_GET["op"]){

        /* Controller para guardar y editar los datos del usuario */
        case "guardaryeditar":
            if(empty($_POST["cat_id"])){
                $categoria->insert_categoria($_POST["cat_nom"]);
            }
            else{
                $categoria->update_categoria($_POST["cat_id"],$_POST["cat_nom"]);
            }
            break;

        /* Controller para listar los datos del usuario */
        case "listar":
            $datos=$categoria->get_categoria();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
            $categoria->delete_categoria($_POST["cat_id"]);
            break;

        /* Controller para mostrar los usuarios por su ID  */
        case "mostrar":
            $datos = $categoria->get_categoria_x_id($_POST["cat_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["cat_id"] = $row["cat_id"];
                    $output["cat_nom"] = $row["cat_nom"];
                }
                echo json_encode($output);
            }
            break;


        case "combo":
            $datos = $categoria->get_categoria();
            $html="";
            $html.="<option label='Seleccionar...'></option>";
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['cat_id']."'>".$row['cat_nom']."</option>"; 
                }
                echo $html;
            }
        break;
    }
?>