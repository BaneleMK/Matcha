<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-Gallery</title>
        <link rel="stylesheet" href="../css/mystyles.css">        
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="../signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="../login/login.php">Login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="../login/logout.php">Logout</a></nvli>
                <nvli><a href="post.php">Post</a></nvli>
                <nvli><a href="viewposts.php">View Posts</a></nvli>
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                <div class="columnflexbox">
                    <table style="border: 4px solid #FF1111; background-color: #EEEEEE;">
                        <tr>
                            <td><img src="../uploads/1.prof.png" alt="picture->img link"></td>
                            <td><?php 
                                require_once("../config/setup.php");

                                $userid = $_GET['id'];
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
                            <td colspan=2>additional pic one
                            additional pic two
                            additional pic three
                            additional pic four
                            additional pic V</td>
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
                </div>
            </div>   
        </div>
    </body>
</html>