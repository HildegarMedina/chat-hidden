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
    
                    <div class="messages"></div>

                    <div class="msgsend">
                        <textarea name="msgcontent" required rows="1" class="form-control" id="msgcontent" placeholder="Wirte a message..."></textarea>
                        <input type="submit" value="Send" class="btn btn-primary btn-block">
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
    <script>
    
        $(document).ready(function() {

            //Cargar chat
            $(".messages").load("chat-content.php");

            //Al enviar el formulario
            $("#chat-join").submit(function(e){

                var msg = $("#msgcontent").val();

                //Evitar redirección
                e.preventDefault();

                //Add hyip
                $.ajax({
                    
                    url: "index.php",
                    method: "POST",
                    data: {
                        msg: msg
                    },
                    beforeSend:function(response) {

                        $(".btn").removeClass("btn-primary");
                        $(".btn").addClass("btn-dark");
                        $(".btn").attr("value", "Sending...");

                    },
                    success:function(response) {

                        console.log(response);

                        //Si se ingresa
                        if (response == "success") {

                            $(".btn").addClass("btn-success");
                            $(".btn").removeClass("btn-dark");
                            $(".btn").attr("value", "Send successfuly");

                            //Cargar chat
                            $(".messages").load("chat-content.php");

                            setTimeout(function(){
                                $(".btn").removeClass("btn-success");
                                $(".btn").addClass("btn-primary");
                                $(".btn").attr("value", "Send");
                            }, 4000);
                        
                        //Si da error
                        }else {
                          
                            $(".btn").addClass("btn-danger");
                            $(".btn").removeClass("btn-dark");
                            $(".btn").attr("value", "Error sending message");

                            setTimeout(function(){
                                $(".btn").removeClass("btn-danger");
                                $(".btn").addClass("btn-primary");
                                $(".btn").attr("value", "Send");
                            }, 4000);
                        
                        }
                        
                    },
                    error: function(response) {console.log(response);

                        $(".btn").addClass("btn-danger");
                        $(".btn").removeClass("btn-dark");
                        $(".btn").attr("value", "Fatal error");

                        setTimeout(function(){
                            $(".btn").removeClass("btn-danger");
                            $(".btn").addClass("btn-primary");
                            $(".btn").attr("value", "Send");
                        }, 4000);

                    }

                });

            });

            //Revisar mensajes
            setInterval(function(){
                $(".messages").load("chat-content.php");
            }, 2000);

        });

    </script>
    
</body>
</html>