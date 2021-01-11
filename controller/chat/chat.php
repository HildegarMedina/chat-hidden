<?php 

    class Chat_Controller {

        //Unirse al chat
        public static function join($hashjoin) {
            
            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Llamar el modelo chat
            require_once("model/chat/chat.php");

            if ($hashjoin == $_COOKIE["hash"]) {
                header("location:index.php?msg=error-hash");
            }else {

                //Verificamos que esté en la base de datos
                $result = Users_Model::searchUser($hashjoin);
    
                //Si no existe
                if (!$result) {
                    require_once("view/chat.php");
                    header("location:index.php?msg=user-not-found");
                }else {
    
                    //Establecer cookie del chat privado
                    setcookie("join", $hashjoin, time()+3600000, "localhost/chat-hidden/");
    
                    ///Tomar hash
                    $hash = $_COOKIE["hash"];
    
                    //Añadir nuevo chat
                    Chat_Model::addChat($hash, $hashjoin);
                    header("location:index.php");
    
                }

            }


        }

        //Mostrar chat
        public static function showChat() {

            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Llamar el modelo chat
            require_once("model/chat/chat.php");

            //Buscar el nick
            $nick = Users_Model::searchUser($_COOKIE["hash"]);

            //Mostrar mensajes
            return Chat_Model::showChat($nick);

        }

        //Enviar mensaje
        public static function sendMsg($msg) {

            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Llamar el modelo chat
            require_once("model/chat/chat.php");

            //Buscar el nick
            $nick = Users_Model::searchUser($_COOKIE["hash"]);

            //Mostrar mensajes
            return Chat_Model::sendMsg($msg, $nick);
        }

    }