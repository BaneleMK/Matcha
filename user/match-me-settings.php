<?php

session_start();
require_once('../config/setup.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Match me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">     
</head>
<body>

    <?php include('../includes/navbar.php');?>
    <div class="container">
    
    <div class="row">
        <div class="col-sm">
            <form action="match-me-settings.php?search" method="GET">
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Age range</label>
                  </div>
                  <select class="custom-select" name="age1">
                    <?php
                        $age = 18;
                        while ($age < 150){
                            echo '<option value="'.$age.'">'.$age.'</option>';
                            $age++;
                        }
                    ?>
                  </select>
                  <select class="custom-select" name="age2">
                    <?php
                        $age = 18;
                        echo '<option value="150">150</option>';
                        while ($age < 150){
                            echo '<option value="'.$age.'">'.$age.'</option>';
                            $age++;
                        }
                    ?>
                  </select>
            </div>
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Fame rating</label>
                  </div>
                  <select class="custom-select" name="fame1">
                    <?php
                        $fame = 0;
                        while ($fame < 900){
                            echo '<option value="'.$fame.'">'.$fame.'</option>';
                            $fame += 50;
                        }
                        echo '<option value="9000">9000+</option>';
                    ?>
                  </select>
                  <select class="custom-select" name="fame2">
                    <?php
                        $fame = 0;
                        echo '<option value="9000">9000+</option>';
                        while ($fame < 900){
                            echo '<option value="'.$fame.'">'.$fame.'</option>';
                            $fame += 50;
                        }
                        echo '<option value="9000">9000+</option>';
                    ?>
                  </select>
            </div>
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Location</label>
                  </div>
                  <input type=text name=location placeholder="WIP">
            </div>
            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Tag Matching</label>
                  </div>
                  <select class="custom-select" name="tagmatching">
                    <?php
                            echo '  <option value="1">YEAH</option>
                            <option value="0">NO PLEASE NO</option>';
                    ?>
                  </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <hr/>
            </form>
        </div>
        <div class="col-sm">
            <?php
                if (isset($_GET['age1'])) {
                    echo '<h1>RESULTS:</h1><br/>';
                    require_once('matchme-v2.info.php');
                    echo '<ul class="list-group">
                    <li class="list-group-item list-group-item-dark">
                    <h5>END OF RESULTS</h5>
                    </ul>';
                }
            ?>
            
        </div>
    </div>
    
    </div>

    <!--js for bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>