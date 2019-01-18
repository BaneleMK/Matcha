<?php
    session_start();
    
    require_once("../config/setup.php");
    include("../functions/sanitize.php");
    if (isset($_SESSION['id'], $_GET['id'])) {
        $seekerid = $_SESSION['id'];
        $matchid = $_GET['id'];

        $sql "SELECTCOUNT(*)"
        if () {

        } else {
            $sql = "INSERT INTO matches (matchid, seekerid, result) 
            VALUES (:matchid, :seekerid, :result)";

            $stmt = $conn->prepare("$sql");
            $stmt->bindParam(':matchid', $matchid);
            $stmt->bindParam(':seekerid', $seekerid);

            if ($_GET['result'] == 'yes'){
                $results = 1;
            } else {
                $results = 0;
            }
            $stmt->bindParam(':result', $results);
            $stmt->execute();
        }

        header("Location: matchme.info.php");
        exit();
    } else {
        header("Location: ../login/login.php");
        exit();
    }