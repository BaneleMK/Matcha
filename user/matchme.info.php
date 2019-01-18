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
            $stmt2 = $conn->prepare("SELECT result FROM matches WHERE seekerid = 4 & matchid = 4");
            $stmt2->execute();
            $valid = $stmt2->fetch();

            if ($valid['id']) {
                for($i=0; $match = $stmt->fetch(); $i++) {
                    $matchid = $match['id'];
                    $stmt2->execute();
                    $valid = $stmt2->fetch();

                    if (!$valid['id']) {
                        header("Location: matchme.php?id=".$match['id']);
                        exit();        
                    }
                }
                if (!$match['id']) {
                    header("Location: matchme.php?nomatchanymore");
                    exit();
                }
            } else {
                header("Location: matchme.php?id=".$match['id']);
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