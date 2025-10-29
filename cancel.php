<?php
// Start a session to access the appointment ID
session_start();
// Include the database connection file
require_once('config.php');

// Check if an appointment ID is set in the session variable
if (isset($_SESSION['appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_SESSION['appointment_id']);
    // Update the appointment status to "Canceled"
    $update_query = "UPDATE appointment_form SET status='Canceled' WHERE appointment_id='$appointment_id'";
    $update_result = mysqli_query($conn, $update_query);
    if (!$update_result) {
        // If there is an error in the query, show the error message and exit the script
        echo "Error: " . mysqli_error($conn);
        exit();
    }
    // Unset the appointment ID session variable
    unset($_SESSION['appointment_id']);
    // Show a success message
    echo "<script>alert('Appointment successfully canceled!'); window.location.href = 'welcome.php';</script>";
} else {
    echo "Error: Appointment ID not set in session.";
}
?>