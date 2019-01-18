<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-Profile</title>
        <link rel="stylesheet" href="../css/mystyles.css">      
    </head>
    <body bgcolor=red>
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
                <nvli><a class=active href="socialtab.php">SOCIAL</a></nvli>
                <nvli><a href="matchme.php">MATCH ME</a></nvli>
                <nvli><a href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                        
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <table>
                                    <tr>
                                        <td>Profile Picture</td>
                                        <td><input type="file" name="profilepic" required></td>
                                    </tr>
                                    <tr>
                                        <td><button type="submit" name="submit">SUBMIT</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="personal.info.php?bio" method="POST" id="bioform">
                            <?php
                                    require_once('../config/setup.php');
                                    
                                    $id = $_SESSION['id'];
                                    $sql = "SELECT bio FROM users WHERE id = $id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $bio = $stmt->fetch();

                                    echo '
                                    <div class="commentflexbox">
                                        <table class=table>
                                            <tr>
                                                <td><h3>BIO</h3></td>
                                                <td><textarea rows="3" cols="50" name="bio" form="bioform" required placeholder="Hey, say something :D (max chars:255)">'.$bio['bio'].'</textarea></td>
                                            </tr>
                                            <tr>
                                               <td><button type="submit" name="submit" required>Update bio</button></td>
                                            </tr>
                                        </table>
                                    </div>';
                            ?>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <h1>Pasts likes from people</h1>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <h1>Pasts views from people</h1>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF; height: 80px">
                            <form action="profileinfo.php" method="POST">
                                <h1>Fame rating: 
                                <?php 
                                    $id = $_SESSION['id'];
                                    $sql = "SELECT Fame FROM users WHERE id = $id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $fame = $stmt->fetch();
                                    echo $fame['Fame'];
                                    ?></h1>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <h1>Pasts views from people</h1>
                            </form>
                        </div>
                        </div>
                        <?php
                            include '../messages/phpboxmessages.php';
                        ?>
                    </div>
                </div>
            </div>   
        </div>
    </body>
</html>