<?php

session_start();

if (!isset($_SESSION['username'])) {
    

} else {
    header("Location: ../login/login.php");
    exit();
}