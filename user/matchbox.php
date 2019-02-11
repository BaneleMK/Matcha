<?php

require_once('../config/setup.php');
include_once('../functions/sanitize.php');

  // echo "<br>im now in the file for the matchboxes boss.";
  $chatid = $matchid;

  // echo "<br>btw boss we got here. matchid = $matchid and the userid is =$chatid<br>";

  $sql2 = "SELECT * FROM users WHERE id = '$chatid'";
  $stmt5 = $conn->prepare($sql2);
  $stmt5->execute();

  $row1 = $stmt5->fetch();

  $image = $row1['profilepic'];
  $name = $row1['username'];
  $bio = $row1['bio'];

  $bio = substr(trim($bio), 0, 50)."...";

  if (isset($bio)) {
    echo '<div class="card" style="width: 18rem;">
            <img src="'.$image.'" class="card-img-top" alt="'.$name.'">
            <div class="card-body">
              <h5 class="card-title">'.$name.'</h5>
              <p class="card-text">'.$bio.'</p>
              <a href="matchme.php?id='.$chatid.'" class="btn btn-warning">Check profile</a>
            </div>
          </div>';
  }

?>