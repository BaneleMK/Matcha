<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Match me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">     
</head>
<body>

     <?php include('../includes/navbar.php');?>

    <table class="table">        
        <tr>
            <td><img src="<?php 
                require_once("../config/setup.php");
                $userid = $_GET['id'];

                $sql = "SELECT picture FROM pics WHERE userid = '$userid' AND picrole = 'profile'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $pic = $stmt->fetch();
                echo $pic['picture'];
            ?>" width=200px height=200px alt="picture->img link"></td>
            <td>
            <?php 

                $sql = "SELECT * FROM users where id = $userid";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $sql = "SELECT * FROM usertags where userid = $userid";
                $stmt2 = $conn->prepare($sql);
                $stmt2->execute();

                $info = $stmt->fetch();
                echo '
                Name:'.$info['firstname'].'<br>
                Surname:'.$info['lastname'].'<br>
                Age:'.$info['age'].'<br>
                Gender:'.$info['gender'].'<br>
                Fame:'.$info['Fame'].'<br>
                bio:' . $info['bio'] . "<br>";

                $tag = $stmt2->fetch();
                echo '#'.$tag['tag1'].' |'.'#'.$tag['tag2'].' |'.'#'.$tag['tag3'].' |'.'#'.$tag['tag4'].' |'.'#'.$tag['tag5'];

            ?></td>
        </tr>
        <tr>
            <td colspan=2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <?php
                        require_once('../config/setup.php');

                        $id = $_GET['id'];
                        $stmt = $conn->prepare("SELECT * FROM pics WHERE userid = '$id' ORDER BY picid DESC");
                        $stmt->execute();
                        $row = $stmt->fetchAll();

                                    // $postnumber = the amount of posts per pagination
                        $totalposts = sizeof($row);
                        if ($totalposts != NULL) {
                            echo '
                            <div class="carousel-item active">
                              <img src="../uploads/'. $row[0]['picture']. '" class="d-block w-100" alt="alt image">
                            </div>';
                        }
                        for ($cp = 1; $cp < $totalposts; $cp++) {
                            echo '
                            <div class="carousel-item">
                              <img src="../uploads/'. $row[$cp]['picture']. '" class="d-block w-100" alt="alt image">
                            </div>';
                        }
                        ?>
                     </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </td>
        </tr>
        <tr>
            <?php
                $id = $_GET['id'];
                echo '
                <td><a href="matchmeresults.info.php?result=yes&id='.$id.'"> Like </a></td>
                <td><a href="matchmeresults.info.php?result=no&id='.$id.'"> Pass </a></td>
                ';
            ?>
        </tr>
    </table>
    
    <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>