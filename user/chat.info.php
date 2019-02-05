<?php

session_start();

if (isset($_SESSION['id'])) {
    require_once('../config/setup.php');
    include_once('../functions/sanitize.php');
    
    try {
        $id1 = $_SESSION['id'];
        $id2 = $_POST['receiver'];
        $textmessage = sanitize($_POST['textmessage']);

        $sql = "SELECT COUNT(*) FROM chats WHERE id1 = '$id1' AND id2 = '$id2'";
        $res1 = $conn->query($sql);

        $sql = "SELECT COUNT(*) FROM chats WHERE id1 = '$id2' AND id2 = '$id1'";
        $res2 = $conn->query($sql);

        if (($res1->fetchColumn() > 0) || ($res2->fetchColumn() > 0)) {
            $receiverid = $id2;
            echo 'im here now. the message will be sent';

            $sql = "INSERT INTO messages (textmessage, receiverid, senderid) VALUES(:textmessage, :receiverid, :senderid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':textmessage', $textmessage);
            $stmt->bindParam(':receiverid', $receiverid);
            $stmt->bindParam(':senderid', $id1);
            $stmt->execute();

            header("Location: chat.php?id=$id2");
            exit();
        } else {
            header("Location: chatselect.php?");
            exit();
        }
    } catch (PDOException $e) {
        echo "failed: " . $e->getMessage() . "<br>";
        header("Location: chat.php?id=$id2");
        exit();
    }
} else {
    header("Location: ../login/login.php");
    exit();
}