<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Matcher</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="profile.php">User <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="chat.html">Chat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="matchme.info.php">Match-Me-Now</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Xtra-stuff
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile impressions</a>
                    <a class="dropdown-item" href="#">Profile likers</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        <div class="container">
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
                            <div class="form-group">
                                <label for="oldpassword">Current Password:</label>
                                <input type="email" class="form-control" name="oldpassword" id="Email1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">You need to verify from the new email in order to activate it.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                            <div class="form-group">
                                <label for="Email">Email address</label>
                                <input type="email" class="form-control" name="newemail" id="Email" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">You need to verify from the new email in order to activate it.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                        <div class="formflexbox" style="background-color: #FFFFFF">
                            <a href="post.php">update your proflie pic</a>
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
             
                        <?php
                            include '../messages/phpboxmessages.php';
                        ?>
                    </div>
            </div>
        </div>
    </body>
</html>