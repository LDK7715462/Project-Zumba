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
    $mobile_number = $_POST['mobile_number'];
    $date_of_birth = $_POST['date_of_birth'];

    // Basic validation for email and date_of_birth
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: myaccount.php?error=Invalid email format");
        exit;
    }

    // You can add more specific validation for date_of_birth if needed

    // SQL query to update user's profile using prepared statement
    $sql = "UPDATE customer SET 
            first_name = ?,
            last_name = ?,
            email = ?,
            gender = ?,
            phone = ?,
            date_of_birth = ?
            WHERE customer_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $gender, $mobile_number, $date_of_birth, $customer_id);

    if ($stmt->execute()) {
        // Update successful
        // You can also update the session variables with the new information
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $mobile_number;
        $_SESSION['date_of_birth'] = $date_of_birth;

        header("Location: edit_profile.php?success=Profile updated successfully"); // Redirect to the profile page with a success message
        exit;
    } else {
        header("Location: edit_profile.php?error=Error updating profile"); // Redirect to the profile page with an error message
        exit;
    }
}

// Close the database connection
$conn->close();
?>