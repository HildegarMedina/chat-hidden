<?php

    //Llamar al controlador
    require_once("controller/users/users.php");
    
    //Instancia controlador usuario
    $user = new Users_Controller();

    //Destruir usuario
    $user->destroy();


?>