<?php 

    //Si existe algún mensaje, almacenalo
    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
    }else {
        $msg = "";
    }

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Hidden - Chat</title>

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
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="form-chat" class="mx-auto">
    
                    <?php 

                        //Si el mensaje es de error
                        if ($msg == "user-not-found") {
                            echo '
                            <div class="alert alert-danger" role="alert">
                                <strong>¡Ops!</strong> User not found
                            </div>';
                        }else if ($msg == "error-hash") {
                            echo '
                            <div class="alert alert-danger" role="alert">
                                <strong>¡Ops!</strong> Itś your hash
                            </div>';
                        }


                    ?>
                    <div class="form-group">
                        <label for="chat-with">Chat with...</label>
                        <input type="text" class="form-control" name="hash" id="chat-with" placeholder="hash...">
                    </div>
    
                    <div class="form-group">
                        <input type="submit" name="join-chat" value="Join chat!" class="btn btn-primary btn-block">
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