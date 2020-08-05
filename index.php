<?php

    //Llamar al controlador
    require_once("controller/users/users.php");
    
    //Instancia controlador usuario
    $usuario = new Users_Controller();

    //Mostrar la bienvenida o el chat
    $usuario->home();

?>