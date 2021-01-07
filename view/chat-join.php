<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Hidden - Chat Join</title>

    <!-- STYLES : CSS -->
    <link rel="stylesheet" href="view/assets/css/normalize.css">
    <link rel="stylesheet" href="view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/assets/css/styles.css">
</head>
<body>

    <!-- HEADER -->
    <header class="bg-dark">
        <div class="container text-center p-3">
            <span class="text-white h3">Chat hidden</span>
        </div>
    </header>

    <!-- CONTENT -->
    <main>
        <div class="container">
            <div class="mt-4 mx-auto p-5 border rounded bg-white">
                <h2 class="d-block text-center">Welcome <?php echo $user->nick; ?></h2>
                <span class="d-block my-3">Your hash is: <code><?php echo $_COOKIE["hash"]; ?></code></span>
                <form action="#" method="POST" id="chat-join" class="mx-auto mb-4">
    
                    <div class="messages">
                    
                        <?php 

                            //Requerir modulo
                            require_once("controller/chat/chat.php");
                        
                            //Mostrar mensajes
                            echo Chat_Controller::showChat();

                        ?>

                    </div>

                    <div class="msgsend">
                        <textarea name="msgcontent" rows="1" class="form-control" placeholder="Wirte a message..."></textarea>
                        <input type="submit" value="Enviar" class="btn btn-primary btn-block">
                    </div>
    
                </form>

                <a href="destroy.php" class="text-center text-danger d-block">Destroy user</a>

            </div>
        </div>
    </main>

    <!-- SCRIPTS : JS -->
    <script src="view/assets/js/jquery-3.4.1.min.js"></script>
    <script src="view/assets/js/bootstrap.min.js"></script>
    <script src="view/assets/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>