<?php
    session_start();

    class Conectar{
        protected $dbh;   

        protected function Conexion(){
            try{
                //Local
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=gerlashin_helpdesk","root","");
                //Producción
                //$conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=id18737375_gerlashin_helpdesk","id18737375_hdteam","Bdgerlashin1_");
                
                return $conectar;
            } catch (Exception $e) {
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        public static function ruta(){
            //Local
            return "http://localhost:8081/Helpdesk_Gerlashin/";
            //Producción
            //return "https://helpdesk-gerlashin.000webhostapp.com/";
        }
        
    }
?>