<?php
    session_start();
    echo 'im here';
    require_once("../config/setup.php");
    include("../functions/sanitize.php");
    echo "<br>".'now im there';
    try{
    if (isset($_SESSION['id'], $_GET['id'])) {
        $seekerid = $_SESSION['id'];
        $matchid = $_GET['id'];

        $sql = "SELECT COUNT(*) id FROM matches WHERE matchid = '$matchid' AND seekerid = '$seekerid'";
        $stmt = $conn->query($sql);
        if ($stmt->fetchColumn() > 0) {
            header("Location: matchme.info.php");
            exit();
        } else {
            $sql = "INSERT INTO matches (matchid, seekerid, result) 
            VALUES (:matchid, :seekerid, :result)";

            $stmt = $conn->prepare("$sql");
            $stmt->bindParam(':matchid', $matchid);
            $stmt->bindParam(':seekerid', $seekerid);
            
            // increase the fame level
            $sql = "SELECT fame FROM users WHERE id = '$matchid'";
            $stmt2 = $conn->prepare($sql);
            $stmt2->execute();

            $fame = $stmt2->fetch();
            if ($_GET['result'] == 'yes') {
                // make a new chat link if they both like each other.
                $results = 1;
                $newfame = $fame['fame'] + 10;
            } else {
                $results = 0;
                $newfame = $fame['fame'] + 3;
            }

            $sql = "UPDATE users SET fame = $newfame WHERE id = '$matchid'";
            $stmt2 = $conn->prepare("$sql");
            $stmt2->execute();

            $stmt->bindParam(':result', $results);
            $stmt->execute();

            if ($results == 1) {
                $sql = "SELECT COUNT(*) id FROM matches WHERE matchid = '$seekerid' AND seekerid = '$matchid'";
                $stmt3 = $conn->query($sql);
                if (($stmt3->fetchColumn()) > 0) {
                    // check if it already exists or something

                    $sql = "SELECT COUNT(*) FROM chats WHERE id1 = '$seekerid' AND id2 = '$matchid'";
                    $res1 = $conn->query($sql);
                    $sql = "SELECT COUNT(*) FROM chats WHERE id2 = '$seekerid' AND id1 = '$matchid'";
                    $res2 = $conn->query($sql);

                    if (($res1->fetchColumn() == 0) && ($res2->fetchColumn() == 0)) {
                        echo ' all the way dude </br>';
                        $sql = "INSERT INTO chats (id1, id2) VALUES(:id1, :id2)";
                        $stmt4 = $conn->prepare("$sql");
                        $stmt4->bindParam(':id1', $matchid);
                        $stmt4->bindParam(':id2', $seekerid);
                        $stmt4->execute();
                    }
                }
            }
        }
        header("Location: matchme.info.php");
        exit();
    } else {
        header("Location: ../login/login.php");
        exit();
    }
    } catch (PDOException $e) {
        echo "something failed: " . $e->getMessage() . "<br>";
    }