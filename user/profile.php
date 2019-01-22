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
                <nvli><a href="socialtab.php">SOCIAL</a></nvli>
                <nvli><a href="matchme.info.php">MATCH ME</a></nvli>
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    <div class="formflexbox" style="height:600px; background-color: #FFFFFF">
                    <form action="profileinfo.php" method="POST">
                            <table class=table>
                                <tr>
                                    <td>new username:</td>
                                    <td><input type="text" name="newusername" required></td>
                                </tr>
                                <tr>
                                    <td>password:</td>
                                    <td><input type="password" name="password" required></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
                        <form action="profileinfo.php" method="POST">
                            <hr/>
                            <table class=table>
                                <tr>
                                    <td>old password:</td>
                                    <td><input type="password" name="oldpassword" required></td>
                                </tr>
                                <tr>
                                    <td>new password:</td>
                                    <td><input type="password" name="newpassword" required></td>
                                </tr>
                                <tr>
                                    <td>new password verification:</td>
                                    <td><input type="password" name="newpassword_vr" required></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
                        <form action="profileinfo.php" method="POST">
                            <hr/>
                            <table class=table>
                                <tr>
                                    <td>new email:</td>
                                    <td><input type="text" name="newemail" required></td>
                                </tr>
                                <tr>
                                    <td>password:</td>
                                    <td><input type="password" name="password" required></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
                        <form action="profileinfo.php" method="POST">
                            <hr/>
                            <table class=table>
                                <tr>
                                    <td>email comment notification:</td>
                                    <td>
                                        <?php
                                            require_once("../config/setup.php");
                                            $username = $_SESSION['username'];
                                            $stmt = $conn->prepare("SELECT * FROM users WHERE username ='$username'");
                                            $stmt->execute();
                                            $row = $stmt->fetch();

                                            echo 'current status: '. $row['comment_notifications'];

                                            if ($row['comment_notifications'] != 'OFF') {
                                                echo '
                                                    <select name="comment_notifications">
                                                        <option value="ON">ON</option>
                                                        <option value="OFF">OFF</option>
                                                    </select>';
                                            } else {
                                                echo '
                                                    <select name="comment_notifications">
                                                        <option value="OFF">OFF</option>
                                                        <option value="ON">ON</option>
                                                    </select>';
                                            }
                                            
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
                        </div>
                        <div class="formflexbox" style="height:290px; background-color: #FFFFFF">
                        <form action="personal.info.php?pref" method="POST">
                            <table class=table>
                                </tr>
                                    <td>Gender:</td>
                                    <td><select name="gender">
                                        <?php
                                            $id = $_SESSION['id'];
                                            $sql = "SELECT gender FROM users WHERE id = $id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $op = $stmt->fetch();
                                            $gender = $op['gender'];
                                            echo '<option value="'.$gender.'">'.$gender.'</option>';
                                        ?>
                                        <option value="Other">Other</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Sexuality</td>
                                    <td><select name="sexuality">
                                    <?php
                                        $id = $_SESSION['id'];
                                        $sql = "SELECT sexuality FROM users WHERE id = $id";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $op = $stmt->fetch();
                                        $sexuality = $op['sexuality'];
                                        echo '<option value="'.$sexuality.'">'.$sexuality.'</option>';
                                    ?>
                                        <option value="Bisexual">Bisexual</option>
                                        <option value="Homosexual">Homosexual</option>
                                        <option value="Hetrosexual">Hetrosexual</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td><select name="age">
                                        <?php
                                            require_once('../config/setup.php');
                                            $id = $_SESSION['id'];
                                            $sql = "SELECT age FROM users WHERE id = $id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $op = $stmt->fetch();
                                            $age = $op['age'];
                                            echo '<option value="'.$age.'">'.$age.'</option>';
                                            $age = 18;
                                            while ($age < 150){
                                                echo '<option value="'.$age.'">'.$age.'</option>';
                                                $age++;
                                            }
                                            
                                        ?>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><input type="text" name="location" value='N/A' required></td>
                                </tr>
                                <tr>
                                    <td>Tag matching</td>
                                    <td>
                                    <select type="text" name="tagmatching" placeholder="Empty">
                                        <?php
                                            $sql = "SELECT tagmatching FROM users WHERE id = $id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $op = $stmt->fetch();

                                            if ($op['tagmatching']){
                                                echo '<option value=1>YEAH</option>
                                                <option value=0>NO PLEASE NO</option>';
                                            } else {
                                                echo '<option value=0>NO PLEASE NO</option>
                                                <option value=1>YEAH</option>';
                                            }
                                        ?>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                                </form>
                                <form action="usertags.php?tag" method="POST">
                                <tr>
                                    <td>Tag-1</td>
                                    <td>
                                    <select type="text" name="tag1" placeholder="Empty">
                                        <?php
                                            require_once('../config/setup.php');
                                            $id = $_SESSION['id'];
                                            $sql = "SELECT tag1 FROM usertags WHERE userid = $id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $op = $stmt->fetch();
                                            $tag = $op['tag1'];
                                            echo '<option value="'.$tag.'">'.$tag.'</option>';
                                            $sql = "SELECT tag FROM tags";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            while ($op = $stmt->fetch()){
                                                $tag = $op['tag'];
                                                echo '<option value="'.$tag.'">'.$tag.'</option>';
                                            }
                                        ?>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tag-2</td>
                                    <td>
                                    <select type="text" name="tag2" placeholder="Empty">
                                            <?php
                                                require_once('../config/setup.php');
                                                $id = $_SESSION['id'];
                                                $sql = "SELECT tag2 FROM usertags WHERE userid = $id";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $op = $stmt->fetch();
                                                $tag = $op['tag2'];
                                                echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                $sql = "SELECT tag FROM tags";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                while ($op = $stmt->fetch()){
                                                    $tag = $op['tag'];
                                                    echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tag-3</td>
                                    <td>
                                    <select type="text" name="tag3" placeholder="Empty">
                                            <?php
                                                require_once('../config/setup.php');
                                                $id = $_SESSION['id'];
                                                $sql = "SELECT tag3 FROM usertags WHERE userid = $id";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $op = $stmt->fetch();
                                                $tag = $op['tag3'];
                                                echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                $sql = "SELECT tag FROM tags";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                while ($op = $stmt->fetch()){
                                                    $tag = $op['tag'];
                                                    echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tag-4</td>
                                    <td>
                                    <select type="text" name="tag4" placeholder="Empty">
                                            <?php
                                                $id = $_SESSION['id'];
                                                $sql = "SELECT tag4 FROM usertags WHERE userid = $id";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $op = $stmt->fetch();
                                                $tag = $op['tag4'];
                                                echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                $sql = "SELECT tag FROM tags";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                while ($op = $stmt->fetch()){
                                                    $tag = $op['tag'];
                                                    echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tag-5</td>
                                    <td>
                                    <select type="text" name="tag5" placeholder="Empty">
                                            <?php
                                                require_once('../config/setup.php');
                                                $id = $_SESSION['id'];
                                                $sql = "SELECT tag5 FROM usertags WHERE userid = $id";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $op = $stmt->fetch();
                                                $tag = $op['tag5'];
                                                echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                $sql = "SELECT tag FROM tags";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                while ($op = $stmt->fetch()){
                                                    $tag = $op['tag'];
                                                    echo '<option value="'.$tag.'">'.$tag.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
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