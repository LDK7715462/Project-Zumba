<?php
// Include auth_session.php for session management
include("auth_session.php");
include("db_conn.php");

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['customer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mobile_number = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];

    // SQL query to update user's profile
    $sql = "UPDATE customer SET 
            first_name = '$first_name',
            last_name = '$last_name',
            email = '$email',
            gender = '$gender',
            phone = '$mobile_number',
            date_of_birth = '$date_of_birth'
            WHERE customer_id = $customer_id";

    if ($conn->query($sql) === TRUE) {
        // Update successful
        // You can also update the session variables with the new information
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $mobile_number;
        $_SESSION['date_of_birth'] = $date_of_birth;

        header("Location: myaccount.php"); // Redirect to the profile page
        exit;
    } else {
        header("Location: myaccount.php?error=Error updating profile"); // Redirect to the profile page
        echo "Error updating profile: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>