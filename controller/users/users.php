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
                
            }else if(isset($_COOKIE["join"])) {

                //Tomamos el hash de la cookie
                $hash = $_COOKIE["hash"];

                //Verificamos que esté en la base de datos
                $result = Users_Model::searchUser($hash);

                //Crear instancia de usuario
                $user = new Users_Model($result, $hash);

                require_once("view/chat-join.php");

            }else {
                
                //Tomamos el hash de la cookie
                $hash = $_COOKIE["hash"];

                //Verificamos que esté en la base de datos
                $result = Users_Model::searchUser($hash);

                //Si no se encuentra
                if (!$result) {

                    //Ver formulario para nuevo usuario
                    require_once("view/new-user.php");

                    //Eliminar hash
                    setcookie("hash", "", time()-1);
                }else {

                    //Crear instancia de usuario
                    $user = new Users_Model($result, $hash);

                    //Ver ventana principal del chat
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

                //Establecer cookie del token
                setcookie("hash", $hash, time()+3600000, "localhost/chat-hidden/");

                header("location:index.php");
            }else {
                header("location:index.php");
            }

        }

        //Destruir usuario
        public function destroy () {

            //Lamar el modelo usuario
            require_once("model/users/users.php");

            //Tomamos el hash de la cookie
            $hash = $_COOKIE["hash"];

            //Verificamos que esté en la base de datos
            $result = Users_Model::searchUser($hash);

            //Si no se encuentra
            if (!$result) {

                //Eliminar hash
                setcookie("hash", "", time()-1);
                setcookie("join", "", time()-1);

                //Ir a inicio
                header("location:index.php");

            }else {

                //Crear instancia de usuario
                $user = new Users_Model($result, $hash);

                //Destruir usuario
                $destroy = $user->destroy();

                //Si se destruyó el usuario
                if ($destroy) {
                    //Eliminar hash
                    setcookie("hash", "", time()-1);
                    setcookie("join", "", time()-1);
                }

                //Ir al inicio
                header("location:index.php");
            }

        }

    }
    
?>