<?php

    //Clase user
    class Users_Controller {

        //Constructor
        public function welcome ($nk, $hs) {

            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Si no existe una cookie de sesión
            if (!isset($_COOKIE["hash"])) {
                
                //Hacer instancia de usuario con su hash
                $user = new Users_Model($nk, $hs);
                
            }else {
                
                //Tomamos el hash de la cookie
                $hash = $_COOKIE["hash"];

                //Verificamos que esté en la base de datos
                $result = Users_Model::searchUser($hash);

                //Si no se encuentra
                if (!$result) {
                    require_once("views/new_user.php");
                }else {
                    require_once("views/chat.php");
                }

            }

        }


    }
    
?>