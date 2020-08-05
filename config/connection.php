<?php

    //Clase conexión
    class Connection {
        
        public static function connect () {

            try {
                
                //Crear objeto conexión
                $connect = new PDO("mysql:dbname=chat_hidden;host=localhost", "root", "");

                //Establecer atributos
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Retornar conexión
                return $connect;

                
            } catch (Exception $e) {

                //En caso de error, muestrame el mensaje
                die($e->getMessage());

            }

        }

    }
    
?>