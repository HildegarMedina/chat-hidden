<?php

    //Llamar al controlador
    require_once("controller/users/users.php");
    
    //Instancia controlador usuario
    $user = new Users_Controller();

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
        $user->join($hashjoin);
        
    //Si no se envío
    }else {

        //Mostrar el formulario de bienvenida
        $user->home();

    }


?>