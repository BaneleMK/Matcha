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
        
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">SOCIAL <TABle></TABle></li>
              </ol>
            </nav>

            <ul class="list-group">
                <li class="list-group-item list-group-item-success">
                <h3>Fame rating: 
                            <?php 
                                $id = $_SESSION['id'];
                                $sql = "SELECT Fame FROM users WHERE id = $id";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $fame = $stmt->fetch();
                                echo $fame['Fame'];
                            ?></h3></li>
            </ul>
            <br/>
        </div>
                
        <div class="container">

            <div class="row">
                <div class="col-sm">
                    <ul class="list-group">
                        <li class="list-group-item active">People who like you</li>
                            <?php
                                $id = $_SESSION['id'];
                                $sql = "SELECT seekerid FROM matches WHERE  matchid = '$id' AND result = '1' ORDER BY id DESC";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                
                                while ($person = $stmt->fetch()){
                                    $seekerid = $person['seekerid'];
                                    $sql = "SELECT username FROM users WHERE id = '$seekerid'";
                                    $stmt2 = $conn->prepare($sql);
                                    $stmt2->execute();
                                
                                    $seeekerinfo = $stmt2->fetch();
                                    $seekername = $seeekerinfo['username'];
                                
                                    echo '<li class="list-group-item">'.$seekername.'</li>';
                                }
                            ?>
                    </ul>
                </div>
                <div class="col-sm">
                    <ul class="list-group">
                        <li class="list-group-item active">People who viewed you</li>
                                <?php
                                    $id = $_SESSION['id'];
                                    $sql = "SELECT seekerid FROM matches WHERE  matchid = '$id' ORDER BY id DESC";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    
                                    while ($person = $stmt->fetch()){
                                        $seekerid = $person['seekerid'];
                                        $sql = "SELECT username FROM users WHERE id = '$seekerid'";
                                        $stmt2 = $conn->prepare($sql);
                                        $stmt2->execute();

                                        $seeekerinfo = $stmt2->fetch();
                                        $seekername = $seeekerinfo['username'];

                                        echo '<li class="list-group-item">'.$seekername.'</li>';
                                    }
                                ?>
                </div>
            </div>
        </div>

        <div class="container">
            <h1>something</h1>
        </div>
    <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>