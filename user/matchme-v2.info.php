<?php

    try {
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
            // echo "YUPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP";
            require_once("matchbox.php");
        }
        // echo "NOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPe";
    }

    function sexuality ($seekerid, $conn, $famenage) {
        // echo "<br><br>well people are picky so lets pick around";
        if ($seeker['sexuality'] == 'Homosexual') {
            $sql = "SELECT id FROM users WHERE id != '$seekerid' AND gender = '$seekergen' $famenage";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } else if ($seeker['sexuality'] == 'Hetrosexual') {
            $sql = "SELECT id FROM users WHERE id != '$seekerid' AND gender != '$seekergen' AND gender != 'Other' $famenage";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT id FROM users WHERE id != '$seekerid' $famenage";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        // echo "<br>Lets see if we found something";
        // echo "btw boss this is what the sql was like <br>'$sql'";
        return ($stmt->fetch());
    }

    require_once("../config/setup.php");
    include("../functions/sanitize.php");

    if (isset($_SESSION['id'])) {
            // GENDER & SEX PREF MATCHING
            $seekerid = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = $seekerid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $seeker = $stmt->fetch();
            $seekergen = $seeker['gender'];
            $seekertag = $_GET['tagmatching'];

            // echo "just so were clear seekertag = $seekertag but originally was ".$seeker['tagmatching']." just so were clear";
            
            // echo "well we got here boss";
            // echo "lets just make sure we sort out the age query boss";

            $age1 = $_GET['age1'];
            $age2 = $_GET['age2'];

            if ($age1 > $age2) {
                $agemin = $age2;
                $agemax = $age1;
            } else {
                $agemin = $age1;
                $agemax = $age2;
            }

            // echo "fame and age are kind of the same thing. right boss? :)";

            $fame1 = $_GET['fame1'];
            $fame2 = $_GET['fame2'];

            if ($fame2 > $fame1) {
                $famemin = $fame1;
                $famemax = $fame2;
            } else {
                $famemin = $fame2;
                $famemax = $fame1;
            }
            
            if ($famemax == 9000) {
                $famenage = "AND age >= $agemin AND age <= $agemax AND fame >= $famemin";
            } else {
                $famenage = "AND age >= $agemin AND age <= $agemax AND fame >= $famemin AND fame <= $famemax";
            }

            $match = sexuality($seekerid, $conn, $famenage);

            $matchid = $match['id'];
            // echo "<br> gonna be a lil noisey here boss and check whats up at match id = ".$matchid;
            while ($match['id']) {
                echo "okay boss lets check if these people have been matched before<br>";
                $sql = "SELECT id FROM matches WHERE seekerid = '$seekerid' AND matchid = '$matchid'";
                echo $sql;
                $stmt1 = $conn->prepare($sql);
                $stmt1->execute();
                $valid = $stmt1->fetch();
                $validid = $valid['id'];

                // echo 'match id  = '.$matchid.' for the seeker with id ='.$seekerid.'<br> valid id = '.$validid.' <br>';
                if ($valid['id']) {
                     // echo 'not a match, sorry. NEXT!!!!!!!!!!!<br>';
                    $match = $stmt->fetch();
                    $matchid = $match['id'];
                } else {
                     echo 'We can match this peace! ';
                    if ($seekertag) {
                        // echo "Boss ah we need to check the tags 1st for this one seekertag = $seekertag :D <br>";
                        tagmatch($matchid, $seekerid, $conn);
                        $match = $stmt->fetch();
                        $matchid = $match['id'];
                    } else {
                        require_once("matchbox.php");
                        $match = $stmt->fetch();
                        $matchid = $match['id'];
                    }
                }
            }
            $sql = "SELECT id FROM matches WHERE seekerid = '$seekerid' AND matchid = '$matchid'";
            // echo "<h3>well boss sorry, seems like we dont have what they like here anymore.</h3>";
        } else {
            header("Location: ../login/login.php");
            exit();
        }
    } catch (\Throwable $th) {
        // echo $th;
    }