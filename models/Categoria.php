<?php
    class Categoria extends Conectar{

        public function get_categoria(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_categoria WHERE estado=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Insert */
        public function insert_categoria($cat_nom){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="INSERT INTO tm_categoria (cat_id,cat_nom,estado) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Update */
        public function update_categoria($cat_id,$cat_nom){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_categoria set
                cat_nom=?
                WHERE
                cat_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_nom);
            $sql->bindValue(2, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Delete */
        public function delete_categoria($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_categoria 
                SET 
                    estado=0
                WHERE cat_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Registro por ID */
        public function get_categoria_x_id($cat_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL con Procedimientos almacenados*/
            $sql="SELECT * FROM tm_categoria WHERE cat_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>