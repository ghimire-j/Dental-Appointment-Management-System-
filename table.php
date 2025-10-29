<?php
// Connect to the database
require_once('config.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Redirect if not logged in
if (!isset($_SESSION['valid'])) {
    header("Location: signIn.php");
    exit;
}

$email = $_SESSION['email'];

// Function to delete appointment from user panel
function deleteAppointmentFromUserPanel($conn, $appointment_id) {
    $sql = "DELETE FROM user_appointment_table WHERE appointment_id='$appointment_id'";
    if (mysqli_query($conn, $sql)) {
        return true; // Deletion successful
    } else {
        return false; // Error in deletion
    }
}

// Construct the SQL query
$sql = "SELECT appointment_id, first_name, last_name, email, appointment_date, preferred_doctor, Symptoms, status
        FROM appointment_form WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Rest of your HTML code -->

</html>
