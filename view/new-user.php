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
    <title>Chat Hidden - Welcome</title>

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
        
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="form-new" class="mt-4 mx-auto p-5 border rounded bg-white">

            <?php 

                //Si el mensaje es de error
                if ($msg == "error") {
                    echo '
                    <div class="alert alert-danger" role="alert">
                        <strong>Ups! Error</strong>
                    </div>';
                }


            ?>

                <h2>Welcome, you need create a account temporary</h2>
            
                <div class="form-group">
                    <label for="nick">Nick</label>
                    <input type="text" class="form-control" id="nick" name="nick">
                </div>

                <div class="form-group">
                    <label for="hash">Your Hash</label>
                    <?php $number = rand(1000000000000, 9999999999999); $token = md5("$number"); ?>
                    <span class="form-control"><?php echo $token; ?></span>
                    <input type="hidden" name="hash"  id="hash" value="<?php echo $token; ?>">
                </div>

                <p>Important: your hast is used for that other user chat with you</p>

                <input type="submit" class="btn btn-dark btn-block" value="Join now" name="send">

            </form>

        </div>
    </main>

    <!-- SCRIPTS : JS -->
    <script src="view/assets/js/jquery-3.4.1.min.js"></script>
    <script src="view/assets/js/bootstrap.min.js"></script>
    <script src="view/assets/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>