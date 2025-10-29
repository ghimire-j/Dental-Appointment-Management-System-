<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</head>
<body>

<?php
session_start();
include('partials/header.php');
// require_once('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have received POST data from the form
    // $first_name = $_POST['first_name'];
    // $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    // $phone = $_POST['phone'];
    // $appointment_date = $_POST['appointment_date'];
    // $problem = $_POST['problem'];
    // $Preferred_doctor = $_POST['Preferred_doctor'];

    $appointment_id = $_SESSION['appointment_id'];


    // $first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';
    // $last_name = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
    // $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    // $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
    // $preferred_doctor = isset($_SESSION['preferred_doctor']) ? $_SESSION['preferred_doctor'] : '';
    // $appointment_date = isset($_SESSION['appointment_date']) ? $_SESSION['appointment_date'] : '';
    // $Symptoms = isset($_SESSION['symptoms']) ? $_SESSION['symptoms'] : '';
    // // Get the new appointment date from the form submission
    $new_date = mysqli_real_escape_string($conn, $_POST['new_date']);

    // Update the appointment record in the database
    $appointment_id = mysqli_real_escape_string($conn, $_SESSION['appointment_id']);
    $update_query = "UPDATE appointment_form SET appointment_date='$new_date' WHERE appointment_id='$appointment_id'";
    $update_result = mysqli_query($conn, $update_query);

    // Check if the update was successful
    if ($update_result) {
        echo "<script>
                swal({
                    title: 'Success!',
                    text: 'Your appointment has been successfully rescheduled!',
                    icon: 'success',
                }).then(function() {
                    window.location.href = 'welcome.php'; // Fixed typo here
                });
            </script>";
    } else {
        echo "Error rescheduling appointment: " . mysqli_error($conn);
    }
}

// Retrieve the appointment details from the database
$appointment_id = mysqli_real_escape_string($conn, $_SESSION['appointment_id']);
$appointment_query = "SELECT * FROM appointment_form WHERE appointment_id='$appointment_id'";
$appointment_result = mysqli_query($conn, $appointment_query);
if (!$appointment_result) {
    echo "Error retrieving appointment details: " . mysqli_error($conn);
    exit();
}
$appointment_row = mysqli_fetch_assoc($appointment_result);

// Check if the appointment was found in the database
if (!$appointment_row) {
    echo "Error: Appointment not found.";
    exit();
}
?>
</body>
</html>