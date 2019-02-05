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

    <?php include('../includes/navbar.php');?>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="profileinfo.php" method="POST">
                            <div class="form-group">
                                <label for="newusername">New Username</label>
                                <input type="text" class="form-control" name="newusername" id="Email1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">Plese make it different, dont be trollin kay.</small>
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr/>
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
                <hr/>
                <form action="profileinfo.php" method="POST">
                            <div class="form-group">
                                <label for="oldpassword">Current Password:</label>
                                <input type="email" class="form-control" name="oldpassword" id="Email1" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">You need to verify from the new email in order to activate it.</small>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="newpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password verification</label>
                                <input type="password" name="newpassword_vr" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr/>
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
                <hr/>
                <form action="profileinfo.php" method="POST">
                            <div class="form-group">
                                <label for="Email notification">Email notification</label>
                                <small id="emailHelp" class="form-text text-muted">
                                    <?php
                                        require_once('../config/setup.php');
                                        $id = $_SESSION['id'];
                                        $stmt = $conn->prepare("SELECT * FROM users WHERE id = $id");
                                        $stmt->execute();
                                        $row = $stmt->fetch();
                                        $status = $row['comment_notifications'];

                                        echo 'current status: '.$status;
                                    ?>
                                </small>
                                <select name="comment_notifications">
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                </form>
            </div>
            <div class="col-sm">
                <form action="personal.info.php?pref" method="POST">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">gender</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Sexuality</label>
                      </div>
                      <select class="custom-select" name="sexuality">
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
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Age</label>
                      </div>
                      <select class="custom-select" name="age">
                        <?php
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
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag Matching</label>
                      </div>
                      <select class="custom-select" name="tagmatching">
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
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <hr/>
                </form>
                <div class="formflexbox" style="background-color: #FFFFFF">
                        <a href="post.php">update your proflie pic</a>
                </div>
                <hr/>
                <div class="formflexbox" style="background-color: #FFFFFF">
                    <form action="personal.info.php?bio" method="POST" id="bioform">
                    <?php
                            require_once('../config/setup.php');                                    
                            $id = $_SESSION['id'];
                            $sql = "SELECT bio FROM users WHERE id = $id";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $bio = $stmt->fetch();

                            echo'
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Bio</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">'.$bio['bio'].'</textarea>
                            </div>
                            ';
                    ?>
                    </form>
                </div>
                <hr/>
                <form action="usertags.php?tag" method="POST">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag#1</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag#2</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag#3</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag#4</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tag#5</label>
                      </div>
                      <select class="custom-select" name="gender">
                        <?php
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
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <?php
                include '../messages/phpboxmessages.php';
            ?>
            </div>
            <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        </div>
    </div>
</body>
</html>