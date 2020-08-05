<?php

    //Llamar al controlador
    require_once("controller/users/users.php");
    
    //Instancia controlador usuario
    $user = new Users_Controller();

    //En caso de que se haya enviado el formulario
    if (isset($_POST["send"])) {
        
        //Obtener datos
        $nick = $_POST["nick"];
        $hash = $_POST["hash"];

        //Agregar el usaurio nuevo
        $user->userNew($nick, $hash);

    //Si no se envío
    }else {

        //Mostrar el formulario de bienvenida
        $user->home();

    }


?>