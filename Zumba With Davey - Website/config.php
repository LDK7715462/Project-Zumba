<?php

// Function to set session variables when the user is logged in
function get_session_variables()
{
    global $customer_id, $first_name, $last_name, $email, $gender, $mobile_number, $date_of_birth, $concessions;

    // Check if the user is logged in
    if (is_user_logged_in()) {

            // Get the session variables
            $customer_id = $_SESSION['customer_id'];
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
            $email = $_SESSION['email'];
            $gender = $_SESSION['gender'];
            $mobile_number = $_SESSION['phone'];
            $date_of_birth = $_SESSION['date_of_birth'];
            $concessions = $_SESSION['no_concession'];

            // Set the session variables (if needed, you can update these as well)
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            $_SESSION['phone'] = $mobile_number;
            $_SESSION['date_of_birth'] = $date_of_birth;
            $_SESSION['no_concession'] = $concessions;
        }
    }
    // Function to clear session variables when the user logs out
    function clear_session_variables()
    {
        unset($_SESSION['customer_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['email']);
        unset($_SESSION['gender']);
        unset($_SESSION['phone']);
        unset($_SESSION['date_of_birth']);
        unset($_SESSION['no_concession']);
    }

    // Function to check if the user is logged in
    function is_user_logged_in()
    {
        return isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id']);
    }

    // Function to display the customer's details
    function display_customer_details()
    {
        global $customer_id, $first_name, $last_name, $email, $gender, $mobile_number, $date_of_birth, $concessions;

        if (is_user_logged_in()) {
            // Retrieve session variables
            get_session_variables();
        } else {
            echo "You are not logged in.";
        }
    }

    function format_phone(string $mobile_number)
    {
        return preg_replace(
            "/.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4})/",
            '($1) $2-$3',
            $mobile_number
        );
    }
?>
