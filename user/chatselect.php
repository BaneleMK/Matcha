<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}
require_once('../config/setup.php');
include_once('../functions/sanitize.php');
?>

<!DOCTYPE html>
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
          
          <div class="container">
            <div class="row">
              <?php
              try{
                $userid = $_SESSION['id'];

                $sql = "SELECT * FROM chats WHERE id1 = $userid OR id2 = $userid";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                while ($row = $stmt->fetch()){

                  if ($userid == $row['id1'])
                    $chatid = $row['id2'];
                  else 
                    $chatid = $row['id1'];
                    

                  $sql = "SELECT * FROM users WHERE id = '$chatid'";
                  $stmt2 = $conn->prepare($sql);
                  $stmt2->execute();

                  $row1 = $stmt2->fetch();

                  $image = $row1['profilepic'];
                  $name = $row1['username'];
                  $bio = $row1['bio'];

                  if (isset($bio)) {
                    echo '<div class="card" style="width: 18rem;">
                      <img src="'.$image.'" class="card-img-top" alt="'.$name.'">
                      <div class="card-body">
                        <h5 class="card-title">'.$name.'</h5>
                        <p class="card-text">'.$bio.'</p>
                        <a href="chat.php?id='.$chatid.'" class="btn btn-info">CHAT!!!</a>
                      </div>
                    </div>';
                  }
                }
                } catch (PDOException $e){
                  echo $e->getmessage();
                }
              ?>
            </div>
            <h3>NO MORE RESULTS BRUH</h3>
          </div>
    <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>