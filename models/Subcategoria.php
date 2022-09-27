<?php
    class Subcategoria extends Conectar{

        public function get_subcategoria($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT * FROM tm_subcategoria WHERE cat_id=? AND estado=1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_subcategoria_all(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            tm_subcategoria.subcat_id,
            tm_subcategoria.cat_id,
            tm_subcategoria.subcat_nom,
            tm_categoria.cat_nom
            FROM tm_subcategoria INNER JOIN
            tm_categoria on tm_subcategoria.cat_id = tm_categoria.cat_id
            WHERE tm_subcategoria.estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert */
        public function insert_subcategoria($cat_id,$subcat_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_subcategoria (subcat_id,cat_id,subcat_nom,estado) VALUES (NULL,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $subcat_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update */
        public function update_subcategoria($subcat_id,$cat_id,$subcat_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_subcategoria set
                cat_id = ?,
                subcat_nom = ?
                WHERE
                subcat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $subcat_nom);
            $sql->bindValue(3, $subcat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete */
        public function delete_subcategoria($subcat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_subcategoria SET
                estado = 0
                WHERE 
                subcat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $subcat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_subcategoria_x_id($subcat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_subcategoria WHERE subcat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $subcat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>