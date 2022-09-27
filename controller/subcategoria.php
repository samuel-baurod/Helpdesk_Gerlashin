<?php
    //Llamada a las clases necesarias
    require_once("../config/conexion.php");
    require_once("../models/Subcategoria.php");
    $subcategoria = new Subcategoria();

    switch($_GET["op"]){
        
        /* Controller para guardar y editar los datos del usuario */
        case "guardaryeditar":
            if(empty($_POST["subcat_id"])){
                $subcategoria->insert_subcategoria($_POST["cat_id"],$_POST["subcat_nom"]);
            }
            else{
                $subcategoria->update_subcategoria($_POST["subcat_id"],$_POST["cat_id"],$_POST["subcat_nom"]);
            }
            break;

        /* Controller para listar los datos del usuario */
        case "listar":
            $datos=$subcategoria->get_subcategoria_all();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["subcat_nom"];
                $sub_array[] = '<button type="button" onclick="editar('.$row["subcat_id"].');" id="'.$row["subcat_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onclick="eliminar('.$row["subcat_id"].');" id="'.$row["subcat_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
            $subcategoria->delete_subcategoria($_POST["subcat_id"]);
            break;

        /* Controller para mostrar los usuarios por su ID  */
        case "mostrar":
            $datos = $subcategoria->get_subcategoria_x_id($_POST["subcat_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["subcat_id"] = $row["subcat_id"];
                    $output["cat_id"] = $row["cat_id"];
                    $output["subcat_nom"] = $row["subcat_nom"];
                }
                echo json_encode($output);
            }
            break;
        
        case "combo":
            $datos = $subcategoria->get_subcategoria($_POST["cat_id"]);
            $html="";
            if(is_array($datos)==true and count($datos)>0){
                /*$html="<option></option>";*/
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['subcat_id']."'>".$row['subcat_nom']."</option>"; 
                }
                echo $html;
            }
        break;
    }
?>