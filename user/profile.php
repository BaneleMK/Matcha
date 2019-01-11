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
                <nvli><a href="post.php">Post</a></nvli>
                <nvli><a href="viewposts.php">View Posts</a></nvli>
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
                        <form action="profileinfo.php" method="POST">
                            <table class=table>
                                </tr>
                                    <td>Gender:</td>
                                    <td><select name="sexuality">
                                        <option value="Other">Other</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Sexuality</td>
                                    <td><select name="sexuality">
                                        <option value="biosexual">Biosexual</option>
                                        <option value="homosexual">Homosexual</option>
                                        <option value="hetrosexual">Hetrosexual</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><input type="text" name="location" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-1</td>
                                    <td><input type="text" name="tags1" placeholder="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-2</td>
                                    <td><input type="text" name="tags2" placeholder="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-3</td>
                                    <td><input type="text" name="tags3" placeholder="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-4</td>
                                    <td><input type="text" name="tags4" placeholder="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-5</td>
                                    <td><input type="text" name="tags5" placeholder="Empty" required></td>
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
                            <form action="profileinfo.php" method="POST">
                                <h1>Contacts</h1>
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
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <h1>Pasts views from people</h1>
                            </form>
                        </div>
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <form action="profileinfo.php" method="POST">
                                <h1>Fame rating: > 9000</h1>
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