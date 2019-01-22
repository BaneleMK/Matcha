<?php
    
    session_start();
    
    require_once("../config/setup.php");
    include("../functions/sanitize.php");
    if (isset($_SESSION['username'], $_GET['pref'])) {
        $id = sanitize($_SESSION['id']);
        $age = sanitize($_POST['age']);
        $sexuality = sanitize($_POST['sexuality']);
        $gender = sanitize($_POST['gender']);
        $tag = sanitize($_POST['tagmatching']);
        
        //location just opens up too many attacks
        //$location = $_POST['location'];

        $sql = "UPDATE users SET age = $age, sexuality = '$sexuality', gender = '$gender', tagmatching = '$tag' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("Location: profile.php?pdone=".$gender);
        exit();
    } else if (isset($_SESSION['username'], $_GET['bio'])) {
        $id = sanitize($_SESSION['id']);
        $bio = substr(trim(sanitize($_POST['bio'])), 0, 500);
        
        $sql = "UPDATE users SET bio = '$bio' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("Location: profile.php?bdone=");
        exit();
    } else {
        header("Location: ../index.php?");
        exit();
    }