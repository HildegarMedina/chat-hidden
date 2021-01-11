<?php 

    //Requerir modulo
    require_once("controller/chat/chat.php");

    //Mostrar mensajes
    echo Chat_Controller::showChat();

?>