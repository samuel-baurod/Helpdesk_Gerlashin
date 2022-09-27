<?php
    class Notificacion extends Conectar{

        /* TODO: Todos los registros */
        public function get_notificacion_x_usu($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT * FROM tm_notificacion WHERE usu_id=? AND estado=2 LIMIT 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Modelo de MntNotificacion - lista todas las notificaciones */
        public function get_notificacion_x_usu2($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT * FROM tm_notificacion WHERE usu_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_notificacion_estado($not_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_notificacion SET estado=1 WHERE not_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $not_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_notificacion_estado_read($not_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="UPDATE tm_notificacion SET estado=0 WHERE not_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $not_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>