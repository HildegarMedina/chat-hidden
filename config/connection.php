<?php

    //Clase conexión
    class Connection {
        
        public static connection() {

            try {
                
                //Crear objeto conexión
                $connection = new PDO("mysql:dbname=chat-hidden;host=localhost", "root", "");

                //Establecer atributos
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Retornar conexión
                return $connection;

                
            } catch (Exception $e) {

                //En caso de error, muestrame el mensaje
                return $e->getMessage();

            }

        }

    }
    
?>