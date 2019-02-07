<?php

    session_start();
    
    function tagmatch ($matchid, $seekerid, $conn) {
        $sql = "SELECT tag1, tag2, tag3, tag4, tag5 FROM usertags WHERE userid = '$matchid'";
        $stmt1 = $conn->prepare($sql);
        $stmt1->execute();
        $tags1 = $stmt1->fetch();

        $sql = "SELECT tag1, tag2, tag3, tag4, tag5 FROM usertags WHERE userid = '$seekerid'";
        $stmt2 = $conn->prepare($sql);
        $stmt2->execute();
        $tags2 = $stmt2->fetch();

        $results = array_intersect($tags1, $tags2);
        if ($results) {
            echo 'SUGOI DESU!!!!!!!!!!!! <br>';
            header("Location: matchme.php?id=$matchid");
            exit();
        }
    }

    function sexuality ($seekerid, $conn) {
        
        if ($seeker['sexuality'] == 'Homosexual') {
            $sql = "SELECT id FROM users WHERE id != '$seekerid' AND gender = '$seekergen'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } else if ($seeker['sexuality'] == 'Hetrosexual') {
            $sql = "SELECT id FROM users WHERE id != '$seekerid' AND gender != '$seekergen'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT id FROM users WHERE id != '$seekerid'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        return ($stmt->fetch());
    }

    require_once("../config/setup.php");
    include("../functions/sanitize.php");
    try {
        if (isset($_SESSION['id'])) {
            // GENDER & SEX PREF MATCHING
            $seekerid = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = $seekerid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $seeker = $stmt->fetch();
            $seekergen = $seeker['gender'];
            $seekertag = $seeker['tagmatching'];

            $match = sexuality($seekerid, $conn);

            $matchid = $match['id'];
            while ($match['id']) {
                //okay boss lets check if these people have been matched before
                $sql = "SELECT id FROM matches WHERE seekerid = '$seekerid' AND matchid = '$matchid'";
                $stmt1 = $conn->prepare($sql);
                $stmt1->execute();
                $valid = $stmt1->fetch();
                $validid = $valid['id'];

                echo 'match id  = '.$matchid.' for the seeker with id ='.$seekerid.'<br> valid id = '.$validid.' <br>';
                if ($valid['id']) {
                    // echo 'not a match, sorry. NEXT!!!!!!!!!!!<br>';
                    $match = $stmt->fetch();
                    $matchid = $match['id'];
                } else {
                    // echo 'We can match this peace! ';
                    if ($seekertag) {
                        echo 'Boss ah we need to check the tags 1st for this one :D <br>';
                        tagmatch($matchid, $seekerid, $conn);
                        $match = $stmt->fetch();
                        $matchid = $match['id'];
                    } else {
                        header("Location: matchme.php?id=$matchid");
                        exit();
                    }
                }
            }
            header("Location: matchme.php?sorryson-nomore");
            exit();
        } else {
            header("Location: ../login/login.php");
            exit();
        }
    } catch (\Throwable $th) {
        echo $th;
    }