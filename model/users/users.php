<?php

    //Clase user
    class Users_Model {

        //Datos del usuario
        private $nick, $hash;

        //Constructor
        public function __construct($nk, $hs) {
            
            //Establecer el nick y hash de seguridad
            $this->nick = $nk;
            $this->hash = $hs;

        }

        //Mostrar nick
        public function showNick() {
            echo $this->nick;
        }

        //Buscar usuario por hash
        public static function searchUser($hash) {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql = "SELECT nick FROM 'user' WHERE hash = :hash";

            //Preparar consulta
            $resultado = $db->prepare($sql);

            //Ejecutar consulta
            $resultado->execute(array(":hash"=>$hash));

            //Contar usuario
            $count = $resultado->rowCount();

            //Si encontró el usuario, devuielve el nick
            if ($count > 0) {
                
                while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    $nick = $row["name"]; 
                }

                return $nick;

            }else {
                return false;
            }
            
        }

        //Ingresar usuario a la base de datos
        public function addUser() {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql = "INSERT INTO `users`(`hash`, `nick`, `date`) VALUES (:hash , :nick , NOW())";

            //Preparar consulta
            $resultado = $db->prepare($sql);

            //Ejecutar consulta
            $resultado->execute(array(":hash"=>$this->hash, ":nick"=>$this->nick));

            //Verificar que si se haya ingresado
            $count = $resultado->rowCount();

            //Si se ingresó
            if ($count > 0) {
                return true;
            }else {
                return false;
            }
        }

    }
    
?>