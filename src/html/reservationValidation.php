<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pickup_location']) && isset($_POST['dropoff_location']) &&
        isset($_POST['pickup_date']) && isset($_POST['dropoff_date']) &&
        isset($_POST['pickup_time']) && isset($_POST['dropoff_time'])) {

        $pickup_time = $_POST['pickup_time'];
        $dropoff_time = $_POST['dropoff_time'];

        if ($pickup_time >= "09:30" && $pickup_time <= "17:30" &&
            $dropoff_time >= "09:30" && $dropoff_time <= "17:30") {
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Pickup and dropoff times must be between 9:30 and 17:30.";
        }
    } else {
        $_SESSION['error'] = "Please fill in all required fields.";
    }
}
?>