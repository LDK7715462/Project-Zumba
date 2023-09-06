<?php
    session_start();
    if(!is_user_logged_in()) {
        header("Location: index.php");
        exit();
    }

function set_session_variables($customer_id, $first_name, $last_name, $email, $gender, $mobile_number, $date_of_birth) {
    $_SESSION['customer_id'] = $customer_id;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['gender'] = $gender;
    $_SESSION['phone'] = $mobile_number;
    $_SESSION['date_of_birth'] = $date_of_birth;
}

function clear_session_variables() {
    unset($_SESSION['customer_id']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['email']);
    unset($_SESSION['gender']);
    unset($_SESSION['phone']);
    unset($_SESSION['date_of_birth']);
}

function is_user_logged_in() {
    return isset($_SESSION['customer_id']);
}
