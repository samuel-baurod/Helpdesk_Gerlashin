<?php
    class Prioridad extends Conectar{

        /* TODO: Todos los registros */
        public function get_prioridad(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT * FROM tm_prioridad WHERE estado=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Insert */
        public function insert_prioridad($priori_nom){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="INSERT INTO tm_prioridad (priori_id,priori_nom,estado) VALUES (NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $priori_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Update */
        public function update_prioridad($priori_id,$priori_nom){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_prioridad set
                priori_nom=?
                WHERE
                priori_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $priori_nom);
            $sql->bindValue(2, $priori_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Delete */
        public function delete_prioridad($priori_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_prioridad 
                SET 
                    estado=0
                WHERE priori_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $priori_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Registro por ID */
        public function get_prioridad_x_id($priori_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL con Procedimientos almacenados*/
            $sql="SELECT * FROM tm_prioridad WHERE priori_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $priori_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>