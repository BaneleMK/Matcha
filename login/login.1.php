<?php    
    session_start();
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body bgcolor="red">

    <?php include('../includes/navbar.php');?>
    <br/>
    <br/>

    <div class="row">
        <div class="col-sm">
            <form action="log_in_info.php" method="POST">
            <table class="table">
                <div class="form-group">
                    <label for="newusername">Username</label>
                    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username" require>
                </div>
                <div class="form-group">
                    <label for="newusername">Password</label>
                    <input type="password" class="form-control" name="password" aria-describedby="emailHelp" placeholder="Password" require>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
            <a href="../signup/forgotpassword.php" name="passord_reset">Forgot password?</a>
        <br/>
        </div>
    </div>
    <?php
        include '../messages/phpboxmessages.php';
    ?>

    <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>