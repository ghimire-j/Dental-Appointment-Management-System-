<?php
// Start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once ('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\autoload;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if the appointment form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $Preferred_doctor = mysqli_real_escape_string($conn, $_POST['Preferred_doctor']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);

    // Check if the selected date and time is available
    $check_query = "SELECT COUNT(*) AS count FROM appointment_form  WHERE appointment_date = '$appointment_date'";
    $check_result = mysqli_query($conn, $check_query);
    if ($check_result) {
        $check_row = mysqli_fetch_assoc($check_result);
        if ($check_row['count'] > 0) {
            // If the selected date and time is not available, show an error message
            echo "<script>alert('Sorry, the appointment slot you selected is already booked. Please select another date and time.');</script>";
        } else {
            // Insert the form data into the appointment_form table
            $query = "INSERT INTO appointment_form (first_name, last_name, email, phone, Preferred_doctor, appointment_date, status) VALUES ('$first_name', '$last_name', '$email', '$phone','$Preferred_doctor', '$appointment_date', 'booked')";

            if (mysqli_query($conn, $query)) {
                // If the data is successfully inserted, show a success message
                echo "<script>alert('Appointment booked successfully!');</script>";
                // Save the appointment ID in the session variable for future use
                $_SESSION['appointment_id'] = mysqli_insert_id($conn);
            } else {
                // If there is an error in the query, show an error message
                echo "<script>alert('Error in booking appointment: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        // If there is an error in the query, show an error message
        echo "<script>alert('Error in checking availability: " . mysqli_error($conn) . "');</script>";
    }
}

$to = $email;
$subject = "Reminder: Your appointment with " . $first_name;
$message = "Hello " . $first_name . ",<br><br>This is a friendly reminder that you have an appointment scheduled with us tomorrow at " . $appointment_date . ". Please remember to arrive on time.<br><br>Best regards,<br> Admin<br><br>
        नमस्ते " . $first_name . ", यो एक मैत्रीपूर्ण रिमाइन्डर हो कि तपाइँले भोलि" . $appointment_date . " मा हामीसँग भेट्ने समय तय गर्नुभएको छ।<br><br> समयमै आइपुग्न नभुल्नु होला।<br><br> हार्दिक बधाई,<br> प्रशासक";

$headers = "From: jubingc15@gmail.com\r\n";
$headers .= "Reply-To: jubingc15@gmail.com\r\n";

// Send email using PHPMailer
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'jubingc15@gmail.com';
$mail->Password = 'siqr dqze bdap bomk';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('jubingc15@gmail.com', 'Admin');
$mail->addAddress($to);
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $message;

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}




// Check if the cancel form is submitted
if (isset($_POST['cancel'])) {
    // Update the status of the appointment to "canceled"
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
    $update_query = "UPDATE admin SET status='canceled' WHERE appointment_id='$appointment_id'";
    if (mysqli_query($conn, $update_query)) {
        // If the status is successfully updated, show a success message
        echo "<script>alert('Appointment canceled successfully!');</script>";
    } else {
        // If there is an error in the query, show an error message
        echo "<script>alert('Error in canceling appointment: " . mysqli_error($conn) . "');</script>";
    }
}


// Check if an appointment ID is set in the session variable
if (isset($_SESSION['appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_SESSION['appointment_id']);
    // Retrieve appointment details from the database
    $appointment_query = "SELECT * FROM appointment_form WHERE appointment_id='$appointment_id'";
    $appointment_result = mysqli_query($conn, $appointment_query);
    if (!$appointment_result) {
        // If there is an error in the query, show the error message and exit the script
        echo "Error: " . mysqli_error($conn);
        exit();
    }
    $appointment_row = mysqli_fetch_assoc($appointment_result);
    // If the appointment is not found in the database, show an error message
    if (!$appointment_row) {
        echo "Error: Appointment not found.";
    } else {

        // Generate invoice HTML
        // Generate invoice HTML
        $invoice_html = "<html><head><style>table {border-collapse: collapse; width: 80%; margin: 0 auto; font-family: Arial, sans-serif; color: #333;} th, td {text-align: left; padding: 8px;} tr:nth-child(even){background-color: #f2f2f2}</style></head><body>";
        $invoice_html .= "<div class='content'><div class='zz'><br><br><br><br><br><br>";
        $invoice_html .= "<img src='images/logo.png' alt='Hospital Logo' style='display: block; margin: 0 auto;'>";
        $invoice_html .= "<h3 style='text-align: center;'>Kathmandu Dental</h3>";
        $invoice_html .= "<h2 style='text-align: center;'>Appointment Invoice</h2>";
        $invoice_html .= "<table>";
        $invoice_html .= "<tr><th>Appointment ID:</th><td>" . $appointment_row['appointment_id'] . "</td></tr>";
        $invoice_html .= "<tr><th>First Name:</th><td>" . $appointment_row['first_name'] . "</td></tr>";
        $invoice_html .= "<tr><th>Last Name:</th><td>" . $appointment_row['last_name'] . "</td></tr>";
        $invoice_html .= "<tr><th>Email:</th><td>" . $appointment_row['email'] . "</td></tr>";
        $invoice_html .= "<tr><th>Phone:</th><td>" . $appointment_row['phone'] . "</td></tr>";
        $invoice_html .= "<tr><th>Preferred Doctor:</th><td>" . $appointment_row['Preferred_doctor'] . "</td></tr>";
        $invoice_html .= "<tr><th>Appointment Date:</th><td>" . $appointment_row['appointment_date'] . "</td></tr>";
        $invoice_html .= "</table></div>";
        $invoice_html .= "<div style='text-align:center; margin-top:20px;'>";
        $invoice_html .= "<form method='post' action='reschedule.php'>";
        $invoice_html .= "<input type='hidden' name='appointment_id' value='" . $appointment_row['appointment_id'] . "'>";
        $invoice_html .= "<br> <button onclick='printDiv()' class='print-button' style='background-color: #2f66d4; color: white; width:200px;  font-size: 16px; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;'>Print Invoice</button><br><br>";
        $invoice_html .= "<label for='new_date'>Reschedule Appointment:</label>";
        $invoice_html .= "<input type='date' id='new_date' name='new_date' required>";
        $invoice_html .= "<br>";
        $invoice_html .= "<br>";
        $invoice_html .= "<button type='submit' style='background-color: #4CAF50; width:200px; color: white; font-size: 16px; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer;'>Reschedule</button>";
        $invoice_html .= "</form>";
        $invoice_html .= "<form method='post' action='cancel.php'>";
        $invoice_html .= "<input type='hidden' name='appointment_id' value='" . $appointment_row['appointment_id'] . "'>";
        $invoice_html .= "<button type='submit' style='background-color: #f44336; color: white; width:200px;  font-size: 16px; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px;'>Cancel Appointment</button>";
        $invoice_html .= "</form>";

        $invoice_html .= "</div></div></body></html>";
        $invoice_html .= "<script>
                    function printDiv() {
                        var printContents = document.querySelector('.zz').innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = printContents;
                        window.print();
                        document.body.innerHTML = originalContents;
                    }
                  </script>";

        // Output the invoice HTML
        echo $invoice_html;
    }
} else {
    echo "Error: Appointment ID not set in session.";
}
?>