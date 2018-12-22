<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-post</title>
        <link rel="stylesheet" href="../css/mystyles.css">   
        <meta charset="UTF-8">   
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="../signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="../login/login.php">Login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="../login/logout.php">Logout</a></nvli>
                <nvli><a class=active href="post.php">Post</a></nvli>
                <nvli><a href="viewposts.php">View Posts</a></nvli>
                <nvli><a href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox" style="flex-direction: column;">
                <div class="camtopflexbox">
                    \-CamBooth-/
                    <nvcam id=nvcam>
                        <nvli style="float: left;"><a id=webcam>webcam</a></nvli>
                        <nvli><a id=picupload>upload picture</a></nvli>
                    </nvcam>
                </div>
                <div class="cammidflexbox">
                    <div class="separationflexbox">
                    <form action=uploadpic.php id=submitform method=POST enctype=multipart/form-data>
                        <div id="picmethod">
                            <video id="video" name=file>
                                There was an error in getting the camera feed.<br>
                            </video>
                        </div>
                    </div>
                    <div class="separationflexbox">
                        <div class="stickerflexbox" style="align-items: flex-start">

                            <table style="width: 90%;height: 20%;">
                                <tr>
                                    <td>Sticker1</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="sticker0" form=submitform>
                                            <option value="none">pick any sticker</option>
                                            <option value="../Resources/heart_off.png">black heart</option>
                                            <option value="../Resources/Sansdad.png">skelly-ton</option>
                                            <option value="../Resources/facefurr.png">facefurr</option>
                                            <option value="../Resources/BIGSALE.png">BIGSALE</option>
                                            <option value="../Resources/VeryAngryBird.png">Angrybird</option>
                                            <option value="../Resources/Christmasf1.png">Christmas frame 1</option>
                                            <option value="../Resources/Christmasf2.png">Christmas frame 2</option>
                                            <option value="../Resources/Christmasf3.png">Christmas frame 3</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 90%;height: 20%;">
                                <tr>
                                    <td>Sticker2</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="sticker1" form=submitform>
                                            <option value="none">pick any sticker</option>
                                            <option value="../Resources/heart_off.png">black heart</option>
                                            <option value="../Resources/Sansdad.png">skelly-ton</option>
                                            <option value="../Resources/facefurr.png">facefurr</option>
                                            <option value="../Resources/BIGSALE.png">BIGSALE</option>
                                            <option value="../Resources/VeryAngryBird.png">Angrybird</option>
                                            <option value="../Resources/Christmasf1.png">Christmas frame 1</option>
                                            <option value="../Resources/Christmasf2.png">Christmas frame 2</option>
                                            <option value="../Resources/Christmasf3.png">Christmas frame 3</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 90%;height: 20%;">
                                <tr>
                                    <td>Sticker3</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="sticker2" form=submitform placeholder="hey pick any">
                                            <option value="none">pick any sticker</option>
                                            <option value="../Resources/heart_off.png">black heart</option>
                                            <option value="../Resources/Sansdad.png">skelly-ton</option>
                                            <option value="../Resources/facefurr.png">facefurr</option>
                                            <option value="../Resources/BIGSALE.png">BIGSALE</option>
                                            <option value="../Resources/VeryAngryBird.png">Angrybird</option>
                                            <option value="../Resources/Christmasf1.png">Christmas frame 1</option>
                                            <option value="../Resources/Christmasf2.png">Christmas frame 2</option>
                                            <option value="../Resources/Christmasf3.png">Christmas frame 3</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="cambotflexbox">
                    <button id="camshot">take pic</button>
                    <!--<button id="clear">clear pics</button>
                    <select id="effect">
                        <option value="none">normal</option>
                        <option value="grayscale(100%)">grayscale</option>
                        <option value="sepia(100%)">sepia</option>
                        <option value="invert(100%)">invert</option>
                        <option value="blur(5px)">blur</option>
                    </select>-->
                    <button id="submit" type=submit name="submit">submit</button>
                </div>
                <div class="campicflexbox">
                    <input type=text name=webcampic id=base64imglink value="empty" style="display:none;">
                    <canvas id="canvas"><!-- style="display:none;">-->
                    
                    </canvas>
                    <?php
                        include '../messages/phpboxmessages.php';
                    ?>
                </div>
                <div class="thumbnailflexbox">
                    <?php
                        require_once('../config/setup.php');

                        $user = $_SESSION['username'];
                        $stmt = $conn->prepare("SELECT * FROM posts WHERE username = '$user' ORDER BY id DESC");
                        $stmt->execute();
                        $row = $stmt->fetchAll();

                        // $postnumber = the amount of posts per pagination
                        $totalposts = sizeof($row);
                        for ($cp = 0; $cp < $totalposts; $cp++) {
                            echo '
                            <a href="comments.php?post=' . $row[$cp]['id'] . '">
                                <img src="../uploads/' . $row[$cp]['picture'] . '" width=60 height=60>
                            </a>';
                        }
                    ?>
                </div>
                <script src="../js/postcam.js"></script>
            </form>
            </div>   
        </div>
    </body>
</html>