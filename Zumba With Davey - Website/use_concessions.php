<?php
session_start();
require_once("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];
    
    if ($action === "decrement") {
        // Get the current value from the database
        $sql = "SELECT no_concession FROM customer WHERE customer_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $_SESSION["customer_id"]);
        $stmt->execute();
        $stmt->bind_result($currentValue);
        $stmt->fetch();
        $stmt->close();

        if ($currentValue > 0) {
            // Decrement the value
            $newValue = $currentValue - 1;

            // Update the database with the new value
            $sql = "UPDATE customer SET no_concession = ? WHERE customer_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $newValue, $_SESSION["customer_id"]);
            $stmt->execute();
            $stmt->close();

            echo json_encode(["success" => true, "new_value" => $newValue]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
}
?>