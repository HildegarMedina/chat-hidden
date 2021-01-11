<?php

    //Clase user
    class Chat_Model {

        //Crear nuevo chat
        public static function addChat($hash, $joinhash) {

            require_once("config/connection.php");
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql_verify = "SELECT * FROM chats WHERE hash1 = :hash OR hash2 = :hash";

            //Preparar consulta
            $resultado_verify = $db->prepare($sql_verify);

            //Ejecutar consulta
            $resultado_verify->execute(array(":hash"=>$hash));

            //Contar usuario
            $count_verify = $resultado_verify->rowCount();

            if ($count_verify == 0) {
                
                ///Consulta
                $sql = "INSERT INTO `chats`(`hash1`, `hash2`, `date`) VALUES (:hash1 , :hash2 , NOW())";
    
                //Preparar consulta
                $resultado = $db->prepare($sql);
    
                //Ejecutar consulta
                $resultado->execute(array(":hash1"=>$hash, ":hash2"=>$joinhash));
    
                //Verificar que si se haya ingresado
                $count = $resultado->rowCount();
    
                //Si agregó el chat
                if ($count > 0) {
                    return true;
                }else {
                    return false;
                }

            }else {
                return true;
            }

            
        }

        //Mostrar mi chat
        public static function showChat($nick) {

            require_once("config/connection.php");

            $hash = $_COOKIE["hash"];
            
            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql_verify = "SELECT * FROM chats WHERE hash1 = :hash OR hash2 = :hash";

            //Preparar consulta
            $resultado_verify = $db->prepare($sql_verify);

            //Ejecutar consulta
            $resultado_verify->execute(array(":hash"=>$hash));

            //Contar usuario
            $count_verify = $resultado_verify->rowCount();

            if ($count_verify != 0) {
                
                while($row=$resultado_verify->fetch(PDO::FETCH_ASSOC)) {
                    $id_chat = $row["id"];

                    //Consulta
                    $sql_msgs = "SELECT * FROM messages WHERE id_chat = :id";

                    //Preparar consulta
                    $resultado_msgs = $db->prepare($sql_msgs);

                    //Ejecutar consulta
                    $resultado_msgs->execute(array(":id"=>$id_chat));

                    //Contar usuario
                    $count_msgs = $resultado_msgs->rowCount();

                    $messages = "";

                    if ($count_msgs > 0) {
                        while ($row_msgs = $resultado_msgs->fetch(PDO::FETCH_ASSOC)) {
                            
                            $nickmsg = $row_msgs["author"];

                            //Buscar id
                            $sql_user = "SELECT * FROM users WHERE id = :id";

                            //Preparar consulta
                            $resultado_user = $db->prepare($sql_user);

                            //Ejecutar consulta
                            $resultado_user->execute(array(":id"=>$nickmsg));

                            while ($row_user=$resultado_user->fetch(PDO::FETCH_ASSOC)) {
                                $nickmsg = $row_user["nick"];
                            }

                            $msg = $row_msgs["content"];
                            if ($nick != $nickmsg) {
                                $messages .= '
                                <div class="msghe mb-3">
                                    <h5 class="mb-0"><b>' . $nickmsg . ':</b></h5>
                                    <p class="mb-0">' . $msg . '</p>
                                </div>
                                ';
                            }else {
                                $messages .= '
                                <div class="msgme mb-3">
                                    <h5 class="mb-0"><b>' . $nickmsg . ':</b></h5>
                                    <p class="mb-0">' . $msg . '</p>
                                </div>
                                ';
                            }
                        }
                    }

                }

                return $messages;
            }else {
                return "Empty";
            }

            
        }

        //Enviar mensaje
        public static function sendMsg($msg, $nick) {

            require_once("config/connection.php");

            $hash = $_COOKIE["hash"];

            //Hacemos la conexión
            $db = Connection::connect();

            //Consulta
            $sql_verify = "SELECT * FROM chats WHERE hash1 = :hash OR hash2 = :hash";

            //Preparar consulta
            $resultado_verify = $db->prepare($sql_verify);

            //Ejecutar consulta
            $resultado_verify->execute(array(":hash"=>$hash));

            while($row=$resultado_verify->fetch(PDO::FETCH_ASSOC)) {

                //Id del chat
                $id_chat = $row["id"];

                //Buscar id
                $sql_user = "SELECT * FROM users WHERE nick = :nick";

                //Preparar consulta
                $resultado_user = $db->prepare($sql_user);

                //Ejecutar consulta
                $resultado_user->execute(array(":nick"=>$nick));

                while ($row_user=$resultado_user->fetch(PDO::FETCH_ASSOC)) {
                    $nick_id = $row_user["id"];
                }

                //Consulta
                $sql_msgs = "INSERT INTO `messages`(`content`, `author`, `id_chat`) VALUES(:content, :author, :id_chat)";

                //Preparar consulta
                $resultado_msgs = $db->prepare($sql_msgs);

                //Ejecutar consulta
                $resultado_msgs->execute(array(":content"=>$msg, ":author"=>$nick_id, ":id_chat"=>$id_chat));

                //Contar registros ingresados
                $count_msgs = $resultado_msgs->rowCount();

                if ($count_msgs > 0) {
                    return true;
                }else {
                    return false;
                }

            }


        }

    }
    
?>