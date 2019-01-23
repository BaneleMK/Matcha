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
                            <td><img src="<?php 
                                require_once("../config/setup.php");
                                $userid = $_GET['id'];

                                $sql = "SELECT picture FROM pics WHERE userid = '$userid' AND picrole = 'profile'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();

                                $pic = $stmt->fetch();
                                echo $pic['picture'];
                            req?>" width=200px height=200px alt="picture->img link"></td>
                            <td><?php 

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
                                <div class="thumbnailflexbox" style="height:270px">
                                    <?php
                                        require_once('../config/setup.php');

                                        $id = $_GET['id'];
                                        $stmt = $conn->prepare("SELECT * FROM pics WHERE userid = '$id' ORDER BY picid DESC");
                                        $stmt->execute();
                                        $row = $stmt->fetchAll();

                                        // $postnumber = the amount of posts per pagination
                                        $totalposts = sizeof($row);
                                        for ($cp = 0; $cp < $totalposts; $cp++) {
                                            echo '
                                            <a href="comments.php?post=' . $row[$cp]['id'] . '">
                                                <img src="../uploads/' . $row[$cp]['picture'] . '" width=220 height=220>
                                            </a>';
                                        }
                                    ?>
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
                </div>
            </div>   
        </div>
    </body>
</html>