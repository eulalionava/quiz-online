<?php
    class Conexion{
        public static function Conectar(){
            define('servidor','localhost');
            define('nombre_db','quiz-online');
            define('usuario','root');
            define('password','141993.ecn');
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8');
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_db,usuario,password,$opciones);
            return $conexion;
        }catch(error $e){
            die('El error de la conexion es:'.$e->getMessage());
        }
        
        }
    }
?>