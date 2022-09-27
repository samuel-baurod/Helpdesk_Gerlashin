<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$cat_id,$subcat_id,$tick_titulo,$tick_descrip,$priori_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="INSERT INTO tm_ticket (tick_id,usu_id,cat_id,subcat_id,tick_titulo,tick_descrip,tick_estado,fecha_creac,usu_asig,fecha_asig,priori_id,estado) VALUES (NULL,?,?,?,?,?,'Abierto',now(),NULL,NULL,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $subcat_id);
            $sql->bindValue(4, $tick_titulo);
            $sql->bindValue(5, $tick_descrip);
            $sql->bindValue(6, $priori_id);
            $sql->execute();

            $sql1="SELECT last_insert_id() as 'tick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fecha_creac,
                tm_ticket.fecha_cierre,
                tm_ticket.usu_asig,
                tm_ticket.fecha_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom,
                tm_ticket.priori_id,
                tm_prioridad.priori_nom
                FROM
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                INNER join tm_prioridad on tm_ticket.priori_id = tm_prioridad.priori_id
                WHERE
                tm_ticket.estado=1
                AND tm_usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.subcat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fecha_creac,
                tm_ticket.fecha_cierre,
                tm_ticket.tick_evalstar,
                tm_ticket.tick_comentstar,
                tm_ticket.usu_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.usu_correo,
                tm_usuario.usu_telf,
                tm_categoria.cat_nom,
                tm_subcategoria.subcat_nom,
                tm_ticket.priori_id,
                tm_prioridad.priori_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_subcategoria on tm_ticket.subcat_id = tm_subcategoria.subcat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                INNER join tm_prioridad on tm_ticket.priori_id = tm_prioridad.priori_id
                WHERE
                tm_ticket.estado = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fecha_creac,
                tm_ticket.fecha_cierre,
                tm_ticket.usu_asig,
                tm_ticket.fecha_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom,
                tm_ticket.priori_id,
                tm_prioridad.priori_nom
                FROM
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                INNER join tm_prioridad on tm_ticket.priori_id = tm_prioridad.priori_id
                WHERE
                tm_ticket.estado=1
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT
                td_ticketdetalle.tickd_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fecha_creac,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM
                td_ticketdetalle
                INNER join tm_usuario on td_ticketdetalle.usu_id = tm_usuario.usu_id
                WHERE
                tick_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();

             /* TODO: Obtener usuario asignado del tick_id */
             $ticket = new Ticket();
             $datos = $ticket->listar_ticket_x_id($tick_id);
             foreach($datos as $row){
                 $usu_asig = $row["usu_asig"];
                 $usu_creac = $row["usu_id"];
             }

            /* TODO: Si Rol es 1 = Usuario, insertar la alerta para usuario de soporte */
            if($_SESSION["rol_id"]==1){
                
                /* TODO: Guardar notificacion de nuevo comentario */
                $sql0="INSERT INTO tm_notificacion (not_id,usu_id,not_msj,tick_id,estado) VALUES (NULL,$usu_asig,'Tiene una nueva respuesta del usuario con nro de Ticket: ',$tick_id,2)";
                $sql0=$conectar->prepare($sql0);
                $sql0->execute();
            /* TODO: Else Rol es = 2 es Soporte, Insertar la alerta para usuario que genero el ticket */
            } else{
                /* TODO: Guardar notificacion de nuevo comentario */
                $sql0="INSERT INTO tm_notificacion (not_id,usu_id,not_msj,tick_id,estado) VALUES (NULL,$usu_creac,'Tiene una nueva respuesta de soporte del Ticket No: ',$tick_id,2)";
                $sql0=$conectar->prepare($sql0);
                $sql0->execute();
            }

            /*Consulta SQL*/
            $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fecha_creac,estado) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();

            /*TODO Devuelve el ultimo ID (Identity) ingresado */
            $sql1="SELECT last_insert_id() as 'tickd_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC); 
        }


        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*Consulta SQL en modo de Procedimientos almacenados*/
            $sql="call sp_i_ticketdetalle_01(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="INSERT INTO td_ticketdetalle
                (tickd_id,tick_id,usu_id,tickd_descrip,fecha_creac,estado)
                VALUES
                (NULL,?,?,'Ticket Re-Abierto...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="update tm_ticket
                set
                    tick_estado = 'Cerrado',
                    fecha_cierre = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function reabrir_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="update tm_ticket
                set
                    tick_estado = 'Abierto'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="update tm_ticket
                set
                    usu_asig = ?,
                    fecha_asig = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();

            /*TODO: Guardar notificación en la tabla*/
            $sql1="INSERT INTO tm_notificacion (not_id,usu_id,not_msj,tick_id,estado) VALUES (NULL,?,'Se le ha asignado el Ticket No. ',?,2)";
            $sql1=$conectar->prepare($sql1);
            $sql1->bindValue(1, $usu_asig);
            $sql1->bindValue(2, $tick_id);
            $sql1->execute();

            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_grafico(){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM tm_ticket JOIN
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id
                WHERE
                tm_ticket.estado=1
                GROUP BY
                tm_categoria.cat_nom
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_encuesta($tick_id,$tick_evalstar,$tick_comentstar){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="update tm_ticket
                set
                    tick_evalstar = ?,
                    tick_comentstar = ?
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_evalstar);
            $sql->bindValue(2, $tick_comentstar);
            $sql->bindValue(3, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function filtrar_ticket($tick_titulo,$cat_id,$priori_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*Consulta SQL*/
            $sql="call filtrar_ticket(?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, "%".$tick_titulo."%");
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $priori_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>