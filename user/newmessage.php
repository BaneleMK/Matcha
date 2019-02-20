<?php
    session_start();
    require_once('../config/setup.php');
    try {
    $userid = $_SESSION['id'];
    $sql = "SELECT * FROM messages WHERE (receiverid = '$id' AND senderid= '$userid') OR senderid= '$id' AND receiverid = '$userid' ORDER BY messageid DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch();
    $mesid = $res['messageid'];
    $lastmessageid = $_GET['lastmessageid'];
    echo "$lastmessageid";
    print_r($res);
    if ($mesid > $lastmessageid) {
        $textmes = $res['textmessage'];
        if ($res['receiverid'] == $id){
          echo "<div id=\"$mesid\" class=\"align-self-end\">$textmes</div>";
        } else {
          echo "<div id=\"$mesid\" class=\"align-self-start\">$textmes</div>";
        }
    }
    } catch(PDOException $e) {
        echo "Table creation failed: " . $e->getMessage() . "<br>";
    }