<?php

    //Llamar al controlador
    require_once("controller/users/users.php");
    require_once("controller/chat/chat.php");
    
    //Instancia controlador usuario
    $user = new Users_Controller();

    //Si se envió un mensaje
    if (isset($_POST["msg"])) {

        //Obtenemos los datos
        $msg = $_POST["msg"];

        //Enviar mensaje
        $resultado = Chat_Controller::sendMsg($msg);

        if ($resultado) {
            die("success");
        }else {
            die("error");
        }

    }

    //En caso de que exista la cookie
    if (isset($_COOKIE["hash"])) {
        
        //Mostrar el formulario de bienvenida
        $user->home();
        
    }

    //En caso de que se haya enviado el formulario de ingreso
    if (isset($_POST["send"])) {
        
        //Obtener datos
        $nick = $_POST["nick"];
        $hash = $_POST["hash"];

        //Agregar el usuario nuevo
        $user->userNew($nick, $hash);

    //En caso de que se haya enviado el formulario de unirse al chat
    }else if(isset($_POST["join-chat"])) {

        //Obtener datos
        $hashjoin = $_POST["hash"];

        //Nos unimos al chat
        Chat_Controller::join($hashjoin);
        
    //Si no se envío
    }else {

        //Mostrar el formulario de bienvenida
        $user->home();

    }


?>