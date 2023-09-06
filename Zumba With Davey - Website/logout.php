<?php
include("auth_session.php");

// Destroy the session and redirect to the login page
clear_session_variables();
session_destroy();
header("Location: index.php");
exit();
?>