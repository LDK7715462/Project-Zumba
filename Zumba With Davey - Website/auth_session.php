<?php
    session_start();
    if(!isset($_SESSION["email"]) && !isset($_SESSION["first_name"]) && !isset($_SESSION["last_name"])) {
        header("Location: login.php");
        exit();
    }
?>