<?php
include "config.php";
    session_start();
    if(!is_user_logged_in()) {
        header("Location: index.php");
        exit();
    }
?>