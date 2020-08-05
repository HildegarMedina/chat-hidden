<?php

    //Clase user
    class Users_Controller {

        
        //Mostrar home
        public function home () {
            
            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Si no existe una cookie de sesión
            if (!isset($_COOKIE["hash"])) {
                
                //Mostrar el formulario de inicio de sesión
                require_once("view/new-user.php");
                
            }else {
                
                //Tomamos el hash de la cookie
                $hash = $_COOKIE["hash"];

                //Verificamos que esté en la base de datos
                $result = Users_Model::searchUser($hash);

                //Si no se encuentra
                if (!$result) {
                    require_once("view/new-user.php");
                }else {
                    require_once("view/chat.php");
                }

            }

        }

        //Mostrar home
        public function userNew ($nick, $hash) {
            
            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Creamos la instancia del usuario
            $user = new Users_Model($nick, $hash);

            //Agregamos el usuario a la base de datos
            $resultado = $user->addUser();

            //Si se ingresa el usuario
            if ($resultado) {
                require_once("view/chat.php");
            }else {
                require_once("view/new-user.php?msg=error");
            }

        }

    }
    
?>