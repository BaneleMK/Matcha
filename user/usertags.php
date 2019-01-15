<?php
session_start();
    
require_once("../config/setup.php");
//echo 'before the rain there was an ';

$id = $_SESSION['id'];

function showtag($tag) {
    $stmt = $conn->prepare("SELECT $tag FROM usertags WHERE userid = $id");
    $stmt->execute();
    $com = $stmt->fetch();
    echo "value=$com[$tag]";
}

if (isset($_GET['tag'])) {
    echo 'if statment';
    
    $sql = "SELECT COUNT(*) username FROM usertags WHERE userid = $id";
    $res = $conn->query($sql);
    if ($res->fetchColumn() > 0) {
        $tag1 = $_POST['tag1'];
        $tag2 = $_POST['tag2'];
        $tag3 = $_POST['tag3'];
        $tag4 = $_POST['tag4'];
        $tag5 = $_POST['tag5'];

        $sql = "UPDATE usertags SET tag1='$tag1', tag2='$tag2', tag3='$tag3', tag4='$tag4', tag5='$tag5' WHERE userid=$id";
        $stmt = $conn->prepare("$sql");

        $stmt->bindParam($tag1, $tag2, $tag3, $tag4, $tag5);
        try {
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Tag update: " . $e->getMessage() . "<br>";
            exit(); 
        }
        header("location: profile.php?tagsredone");
        exit();
    } else {
        $sql = "INSERT INTO usertags (userid, tag1, tag2, tag3, tag4, tag5) 
        VALUES (:userid, :tag1, :tag2, :tag3 ,:tag4, :tag5)";
        $stmt = $conn->prepare("$sql");
        
        $stmt->bindParam(':userid', $id);
        $stmt->bindParam(':tag1', $_POST['tag1']);
        $stmt->bindParam(':tag2', $_POST['tag2']);
        $stmt->bindParam(':tag3', $_POST['tag3']);
        $stmt->bindParam(':tag4', $_POST['tag4']);
        $stmt->bindParam(':tag5', $_POST['tag5']);
        $stmt->execute();
        header("location: profile.php?tagsdone");
        exit();
    }
} else {
    echo 'else statment';
    header("location: profile.php?missingtags");
    exit();
}