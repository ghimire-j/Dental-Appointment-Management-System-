<?php
// Start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once ('config.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the appointment ID from the session
    if (isset($_SESSION['appointment_id'])) {
        $appointment_id = mysqli_real_escape_string($conn, $_SESSION['appointment_id']);
        
        // Update the appointment status to 'completed'
        $update_query = "UPDATE appointment_form SET status='completed' WHERE appointment_id='$appointment_id'";
        
        if (mysqli_query($conn, $update_query)) {
            echo "Appointment status updated to completed.";
        } else {
            echo "Error updating appointment status: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Appointment ID not set in session.";
    }
} else {
    echo "Invalid request method.";
}
?>
