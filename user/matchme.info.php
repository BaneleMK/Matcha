<?php

    session_start();
    
    require_once("../config/setup.php");
    include("../functions/sanitize.php");
    if (isset($_SESSION['id'])) {
        try {
            //code...
        // GENDER & SEX PREF MATCHING
        $userid = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = $userid";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $seeker = $stmt->fetch();

        if ($seeker['sexuality'] == 'Homosexual') {
            $sql = "SELECT id FROM users WHERE id != $userid, gender = ".$seeker['gender'];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $match = $stmt->fetch();
        } else if ($seeker['sexuality'] == 'Hetrosexual') {
            $sql = "SELECT id FROM users WHERE id != $userid, gender != ".$seeker['gender'];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $match = $stmt->fetch();
        } else {
            $sql = "SELECT id FROM users WHERE id != $userid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $match = $stmt->fetch();
        } 
        
        if ($match['id']) {
            $matchid = $match['id'];
            $stmt2 = $conn->prepare("SELECT id FROM matches WHERE seekerid = '$userid' AND matchid = '$matchid'");
            $stmt2->execute();
            $valid = $stmt2->fetch();

            echo "id = ".$valid['id'];
            print_r($valid);
            if (isset($valid)) {
                for($i=0; $match = $stmt->fetch(); $i++) {
                    $matchid = $match['id'];
                    $stmt2->execute();
                    $valid = $stmt2->fetch();

                    if (!$valid['id']) {
                        header("Location: matchme.php?id=".$matchid.'&num='.$i);
                        exit();        
                    }
                }
                if (!$match['id']) {
                    header("Location: matchme.php?nomatchanymore1");
                    exit();
                }
            } else {
                //header("Location: matchme.php?nomatchanymore2&".$valid['id']);
                exit();
            }
        } else {
            header("Location: matchme.php?nomatch");
            exit();
        }
        } catch (\Throwable $th) {
            echo $th;
        }
        /*
        $sql = "SELECT * FROM users WHERE userid = $userid";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        /* TAG MATCHING */
        /*$sql = "SELECT * FROM usertags where userid = $userid";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        */
    } else {
        header("Location: ../login/login.php");
        exit();
    }