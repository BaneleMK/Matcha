<?php
    echo "got here";
    if (isset($_POST['submit'])) {
        require_once("../functions/sanitize.php");
        require_once("../config/setup.php");

        $normpassword = sanitize($_POST['password']);
        $normpassword_vr = sanitize($_POST['password_vr']);
        
        $username = sanitize($_POST['username']);
        $password = hash('whirlpool', $normpassword);
        $email = strtolower(sanitize($_POST['email']));

        $firstname = sanitize($_POST['firstname']);
        $lastname = sanitize($_POST['lastname']);

        $verificationcode = rand(7,9999999);

        if (empty($username) || empty($normpassword) || empty($email) || empty($firstname) || empty($lastname)){
            header("Location: signup.php?signup=empty");
            //echo "theres a space missing.<br>";
            exit ();
        } else if ($normpassword != $normpassword_vr){
            header("Location: signup.php?signup=pwderror");
        }
        else {
            if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
                header("Location: signup.php?signup=names");
                //echo "both first and last names must have only letters<br>";
                exit();
            } else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                header("Location: signup.php?signup=invalidemail");
                //echo "requesting a proper email. if you dont have it...then make it<br>";
                exit();
            } else if (!preg_match("/^[a-zA-Z_0-9]*$/", $username)) {
                header("Location: signup.php?signup=username");
                //echo "Usersnames characters are a-z A-Z 0-9 and underscore '_' <br>";
                exit();
            } else if ($username == 'Admin' || $username == 'admin') {
                header("Location: signup.php?signup=usernamead");
                //echo "Username cant be Admin or admin <br>";
                exit();
            } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST['password'])) {
                header("Location: signup.php?signup=pwdreq");
                //only strong passwords allowed in this db. thanks to psutton3756;
                exit();
            } else {
                $sql = "SELECT COUNT(*) email FROM users WHERE email='$email'";
                $res = $conn->query($sql);
                if ($res->fetchColumn() > 0) {
                    header("Location: signup.php?signup=emailexist");
                    exit();
                }
                $sql = "SELECT COUNT(*) username FROM users WHERE username='$username'";
                $res = $conn->query($sql);
                if ($res->fetchColumn() > 0) {
                    header("Location: signup.php?signup=usernameexist");
                    exit();
                }
                try {
                    $sql = "INSERT INTO users (username, password, email, firstname, lastname, verificationcode) 
                    VALUES (:username, :password, :email, :firstname, :lastname, :verificationcode)";
                    $stmt = $conn->prepare("$sql");

                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':verificationcode', $verificationcode);
                    $stmt->execute();
                } catch(PDOException $e) {
                    header("Location: signup.php?signup=faulty");
                    exit();
                }
                $email_messaage = "
                Eyyy $firstname $lastname

                The following link will verify your account and allow you to go online.
               http://localhost:8080/Camagru/signup/email_verification.php?username=$username&verificationcode=$verificationcode
                ";
                // Multi.Ordinary.Noob.Develop.Etc MAILINATOR.com
                mail($email, "Trender - confirm Email", $email_messaage,"From: Trendernoreply.com");
            }
            header("Location: signup.php?signup=Successfulcreation");
            exit();
        }
    } else {
        header("Location: ../index.php?");
        exit();
    }