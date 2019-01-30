<?php

session_start();

if (!isset($_SESSION['id'])) {
    require_once('../config/setup.php');
    include_once('../functions/sanitize.php');
    
    try {
        $id1 = $_SESSION['id'];
        $id2 = $_POST['receiver'];
        $textmessage = $_POST['textmessage'];


        $sql = "SELECT * FROM chats WHERE id1 = $id1 AND id2 = $id2";
        $res1 = $conn->query($sql);

        $sql = "SELECT * FROM chats WHERE id1 = $id2 AND id2 = $id1";
        $res2 = $conn->query($sql);

        if (($res1->fetchColumn() > 0) || ($res2->fetchColumn() > 0)) {
            $receiverid = $id2;

            // if passes do this
            $sql = "INSERT INTO messages (textmessage, receiverid) VALUES(:textmessage, :receiverid)";
            $stmt->bindParam(':textmessage', $textmessage);
            $stmt->bindParam(':receiverid', $receiverid);
            $stmt->execute();

            echo 'pass for '.$id1.' and '.$id2;
            exit();
        } else {
            echo 'fail for '.$id1.' and '.$id2;
            exit();
        }
    } catch (PDOException $e) {
        //echo "failed: " . $e->getMessage() . "<br>";
        header("Location: comments.php?post=" . $postid . "&error");
        exit();
    }
} else {
    header("Location: ../login/login.php");
    exit();
}