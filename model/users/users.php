<?php

    //Clase user
    class Users_Model {

        //Datos del usuario
        public $nick, $hash;

        //Constructor
        public function __construct($nk, $hs) {
            
            //Establecer el nick y hash de seguridad
            $this->nick = $nk;
            $this->hash = $hs;

        }

        //Buscar usuario por hash
        public static function searchUser($hash) {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql = "SELECT nick FROM users WHERE hash = :hash";

            //Preparar consulta
            $resultado = $db->prepare($sql);

            //Ejecutar consulta
            $resultado->execute(array(":hash"=>$hash));

            //Contar usuario
            $count = $resultado->rowCount();

            //Si encontró el usuario, devuielve el nick
            if ($count > 0) {
                
                while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    $nick = $row["nick"]; 
                }

                return $nick;

            }else {
                return false;
            }
            
        }

        //Crear nuevo chat
        public static function addChat($hash, $joinhash) {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql_verify = "SELECT * FROM chats WHERE hash1 = :hash OR hash2 = :hash";

            //Preparar consulta
            $resultado_verify = $db->prepare($sql_verify);

            //Ejecutar consulta
            $resultado_verify->execute(array(":hash"=>$hash));

            //Contar usuario
            $count_verify = $resultado_verify->rowCount();

            if ($count_verify != 0) {
                
                ///Consulta
                $sql = "INSERT INTO `chats`(`hash1`, `hash2`, `date`) VALUES (:hash1 , :hash2 , NOW())";
    
                //Preparar consulta
                $resultado = $db->prepare($sql);
    
                //Ejecutar consulta
                $resultado->execute(array(":hash1"=>$hash, ":hash2"=>$joinhash));
    
                //Verificar que si se haya ingresado
                $count = $resultado->rowCount();
    
                //Si encontró el usuario, devuielve el true
                if ($count > 0) {
                    return true;
                }else {
                    return false;
                }

            }else {
                return true;
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

        //Eliminar usuario de la base de datos
        public function destroy() {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql_chat = "DELETE FROM chats WHERE hash1 = :hash OR hash2 = :hash";

            //Preparar consulta
            $resultado_chat = $db->prepare($sql_chat);

            //Ejecutar consulta
            $resultado_chat->execute(array(":hash"=>$this->hash));

            //Consulta
            $sql = "DELETE FROM users WHERE hash = :hash";

            //Preparar consulta
            $resultado = $db->prepare($sql);

            //Ejecutar consulta
            $resultado->execute(array(":hash"=>$this->hash));

            //Verificar que si se haya ingresado
            $count = $resultado->rowCount();

            //Si se eliminó
            if ($count > 0) {
                return true;
            }else {
                return false;
            }
        }

    }
    
?>