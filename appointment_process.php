<?php
// Start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once ('config.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\autoload;

// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';


// Check if the appointment form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $preferred_doctor = mysqli_real_escape_string($conn, $_POST['Preferred_doctor']); // Ensure the case matches with the HTML form
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $Symptoms = mysqli_real_escape_string($conn, $_POST['problem']);

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['preferred_doctor'] = $preferred_doctor;
    $_SESSION['appointment_date'] = $appointment_date;
    $_SESSION['symptoms'] = $Symptoms;
    // var_dump($Symptoms);

    // Check if the selected date and time is available
    $check_query = "SELECT COUNT(*) AS count FROM appointment_form  WHERE appointment_date = '$appointment_date'";
    $check_result = mysqli_query($conn, $check_query);
    if ($check_result) {
        $check_row = mysqli_fetch_assoc($check_result);
        if ($check_row['count'] > 0) {
            // If the selected date and time is not available, show an error message
            // header ("location:welcome.php");
            echo "<script>alert('Sorry, you already have an appointment booked for this date. Please select another date or time.');
                window.location.href = 'welcome.php';
                </script>";
        } else {
            // Insert the form data into the appointment_form table
            $query = "INSERT INTO appointment_form (first_name, last_name, email, phone, Preferred_doctor, appointment_date, Symptoms, status) VALUES ('$first_name', '$last_name', '$email', '$phone','$preferred_doctor', '$appointment_date', '$Symptoms', 'Pending')";

            if (mysqli_query($conn, $query)) {
                // If the data is successfully inserted, show a success message
                echo "<script>alert('To verify your booking pay minimal amount, click Pay with KhaltiPayment!');</script>";
                // Save the appointment ID in the session variable for future use
                $_SESSION['appointment_id'] = mysqli_insert_id($conn);
                // Insert a notification
                $message = "Your appointment has been booked for $appointment_date. Your attempt to book is pending due to unpaid minimal amount. Pay to complete the booking process.";
                $notification_query = "INSERT INTO notification (email, name, message, timestamp, is_read) VALUES ('$email', '$first_name $last_name', '$message', NOW(), 0)";
                mysqli_query($conn, $notification_query);
            } else {
                // If there is an error in the query, show an error message
                echo "<script>alert('Error in booking appointment: " . mysqli_error($conn) . "');
                    window.location.href = 'welcome.php';
                    </script>";
            }
        }
    } else {
        // If there is an error in the query, show an error message
        echo "<script>alert('Error in checking availability: " . mysqli_error($conn) . "');
            window.location.href = 'welcome.php';
            </script>";
    }
}

// $to = $email;
// $subject = "Reminder: Your appointment with " . $first_name;
// $message = <<<HTML
// <html>
// <head>
//     <style>
//         body { font-family: "Segoe UI", Roboto, Arial, sans-serif; background-color: #f0f0f0; margin: 0; padding: 0; }
//         .container { max-width: 600px; margin: auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
//         .header { background-color: #00e5ee; color: #fff; padding: 20px; border-top-left-radius: 10px; border-top-right-radius: 10px; text-align: center; }
//         h2 { margin-top: 0; }
//         .content { padding: 20px; color: #555; }
//         .footer { background-color: #f4f4f4; padding: 10px 20px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; }
//         p { margin: 10px 0; }
//         a { color: #007bff; text-decoration: none; }
//         a:hover { text-decoration: underline; }
//     </style>
// </head>
// <body>
//     <div class="container">
//         <div class="header">
//             <h2>Appointment Reminder</h2>
//         </div>
//         <div class="content">
//             <p>Hello $first_name,</p>
//             <p>This is a friendly reminder that you have an appointment scheduled with us atat <b>$appointment_date</b>. Please remember to arrive on time.</p>
//             <p>If you have any questions or need to reschedule, feel free to contact us.</p>
//             <p >Your health is our priority, and we look forward to seeing you!</p>
//         </div>
//         <div class="footer">
//             <p>Best regards,<br>The Kathmandu Dental Team</p>
//             <br>
//             <hr>
//             <br>
//             <p>नमस्ते $first_name,</p>
//             <p>यो एक मैत्रीपूर्ण रिमाइन्डर हो कि तपाइँले भोलि <b>$appointment_date</b> मा हामीसँग भेट्ने समय तय गर्नुभएको छ।</p>
//             <p>समयमै आइपुग्न नभुल्नु होला।</p>
//             <p>कुनै प्रश्न वा रिस्केड्यूल गर्नुपरेमा हामीलाई सम्पर्क गर्नुहोला।</p>
//             <p>तपाईंको स्वास्थ्य हाम्रो प्राथमिकता हो, र हामी तपाईंलाई भेट्न उत्सुक छौं!</p>
//             <p>हार्दिक बधाई,<br>प्रशासक  </p>
//         </div>
//     </div>
// </body>
// </html>
// HTML;

// $headers = "From: jubingc15@gmail.com\r\n";
// $headers .= "Reply-To: jubingc15@gmail.com\r\n";

// // Send email using PHPMailer
// $mail = new PHPMailer;
// $mail->isSMTP();
// $mail->Host = 'smtp.gmail.com';
// $mail->SMTPAuth = true;
// $mail->Username = 'jubingc15@gmail.com';
// $mail->Password = 'siqr dqze bdap bomk';
// $mail->SMTPSecure = 'tls';
// $mail->Port = 587;
// $mail->setFrom('jubingc15@gmail.com', 'Admin-Kathmandu Dental');
// $mail->addAddress($to);
// $mail->isHTML(true);
// $mail->Subject = $subject;
// $mail->Body = $message;

// if (!$mail->send()) {
//     echo 'Message could not be sent.';
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// }

// Check if the cancel form is submitted
if (isset($_POST['cancel'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $preferred_doctor = mysqli_real_escape_string($conn, $_POST['Preferred_doctor']); // Ensure the case matches with the HTML form
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $Symptoms = mysqli_real_escape_string($conn, $_POST['problem']);
    // Update the status of the appointment to "canceled"
    // $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
    $update_query = "UPDATE admin SET status='canceled' WHERE first_name = ? AND last_name = ? AND email = ? AND phone = ? AND appointment_date = ? AND Symptoms = ? AND Preferred_doctor = ?";
    if (mysqli_query($conn, $update_query)) {
        // If the status is successfully updated, show a success message
        echo "<script>alert('Appointment canceled successfully!');</script>";
        $cancel_query = "SELECT * FROM appointment_form WHERE email='$email'";
        $cancel_result = mysqli_query($conn, $cancel_query);
        $cancel_row = mysqli_fetch_assoc($cancel_result);
        $cancel_email = $cancel_row['email'];
        $cancel_name = $cancel_row['first_name'] . ' ' . $cancel_row['last_name'];
        $cancel_message = "Your appointment scheduled for " . $cancel_row['appointment_date'] . " has been canceled.";
        $notification_query = "INSERT INTO notification (email, name, message, timestamp, is_read) VALUES ('$cancel_email', '$cancel_name', '$cancel_message', NOW(), 0)";
        mysqli_query($conn, $notification_query);
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
    }
} else {
    echo "Error: Appointment ID not set in session.";
}


// // Get current date
// $current_date = date('Y-m-d');
// // echo 'bb'. $current_date .'';

// // Calculate the date for the next day
// $next_day_date = date('Y-m-d', strtotime('+1 day'));

// // echo "Next day date: " . $next_day_date;

// // Query appointments scheduled for the next day
// $reminder_query = "SELECT * FROM appointment_form WHERE appointment_date = '$next_day_date'";

// $reminder_result = mysqli_query($conn, $reminder_query);

// if ($reminder_result) {
//     while ($reminder_row = mysqli_fetch_assoc($reminder_result)) {
//         $to = $reminder_row['email'];
//         $subject = "Reminder: Your appointment with la mula bholi app cha " . $reminder_row['first_name'];
//         $message = "Hello " . $reminder_row['first_name'] . ",<br><br>This is a friendly reminder that you have an appointment scheduled with us tomorrow at " . $reminder_row['appointment_date'] . ". Please remember to arrive on time.<br><br>Best regards,<br> Admin<br><br>
//             नमस्ते " . $reminder_row['first_name'] . ", यो एक मैत्रीपूर्ण रिमाइन्डर हो कि तपाइँले भोलि" . $reminder_row['appointment_date'] . " मा हामीसँग भेट्ने समय तय गर्नुभएको छ।<br><br> समयमै आइपुग्न नभुल्नु होला।<br><br> हार्दिक बधाई,<br> प्रशासक";

//         $headers = "From: jubingc15@gmail.com\r\n";
//         $headers .= "Reply-To: jubingc15@gmail.com\r\n";

//         // Send email using PHPMailer
//         $mail = new PHPMailer;
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'jubingc15@gmail.com';
//         $mail->Password = 'siqr dqze bdap bomk';
//         $mail->SMTPSecure = 'tls';
//         $mail->Port = 587;
//         $mail->setFrom('jubingc15@gmail.com', 'Admin-DentBro');
//         $mail->addAddress($to);
//         $mail->isHTML(true);
//         $mail->Subject = $subject;
//         $mail->Body = $message;

//         if (!$mail->send()) {
//             echo 'Message could not be sent.';
//             echo 'Mailer Error: ' . $mail->ErrorInfo;
//         } else {
//             echo 'Reminder email sent successfully to ' . $to;
//         }
//     }
// } else {
//     // If there are no appointments for the next day, no action required
//     echo "No appointments scheduled for the next day.";
// }
// ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Invoice</title>
    <link rel="stylesheet" href="appointment_process.css">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #333;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>

<body>
    <div class='content'>

        <div class="printButton" style=" display: flex;justify-content: space-between;">
            <a href="welcome.php" class="print-button">Home</a>
            <button onclick='printDiv()' class='print-button'>Print Invoice</button>

        </div>

        <div class='zz'>
            <div class="appointmentCard">
                <div class="cardTopContents">
                    <div class="cardImage">
                        <img src='images/logo.png' alt='Hospital Logo'>
                    </div>
                    <h2>Appointment Invoice</h2>
                </div>
                <table class="appointment-table">
                    <tr>
                        <th>Appointment ID:</th>
                        <td><?php echo $appointment_row['appointment_id']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name:</th>
                        <td><?php echo $appointment_row['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name:</th>
                        <td><?php echo $appointment_row['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $appointment_row['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $appointment_row['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Preferred Doctor:</th>
                        <td><?php echo $appointment_row['Preferred_doctor']; ?></td>
                    </tr>
                    <tr>
                        <th>Appointment Date:</th>
                        <td><?php echo $appointment_row['appointment_date']; ?></td>
                    </tr>
                    <tr>
                        <th>Problem :</th>
                        <td><?php echo $appointment_row['Symptoms']; ?></td>
                    </tr>
                    <tr>
                        <th>Status :</th>
                        <td><?php echo $appointment_row['Status']; ?></td>
                    </tr>
                </table>


            </div>
            <div class="actionButtons">
                <div class="reschedule">
                    <!-- <form method='post' action='reschedule.php'> -->
                    <input type='hidden' name='appointment_id'>
                    <br>
                    <br>
                    <!-- <button id="payment-button" style='background-color: #4CAF50; width:200px; color: white; font-size: 16px; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer;'>Minimal
                            Payment</button> -->
                    </form>
                </div>
                <button id="payment-button" class='print-button'>Pay with Khalti</button>

                <script>
                    var config = {
                        // replace the publicKey with yours
                        "publicKey": "test_public_key_f5d5b56d3d174f3188fa75168b38766f",
                        "productIdentity": "1234567890",
                        "productName": "Doctor",
                        "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                        "paymentPreference": [
                            "KHALTI",
                            "EBANKING",
                            "MOBILE_BANKING",
                            "CONNECT_IPS",
                            "SCT",
                        ],
                        "eventHandler": {
                            onSuccess(payload) {
                                // hit merchant api for initiating verfication
                                console.log(payload);
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "save_payment.php", true);
                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        console.log(xhr.responseText);
                                        // After saving payment, update the appointment status to 'completed'
                                        var xhrStatus = new XMLHttpRequest();
                                        xhrStatus.open("POST", "update_status.php", true);
                                        xhrStatus.onreadystatechange = function () {
                                            if (xhrStatus.readyState === 4 && xhrStatus.status === 200) {
                                                console.log(xhrStatus.responseText);
                                                // Optionally, show a message to the user
                                                alert("Payment successful and appointment status updated to completed.");
                                                window.location.href = "appointment_process_paid.php";
                                            }
                                        };
                                        xhrStatus.send();
                                    }
                                };
                                var data = "token=" + encodeURIComponent(payload.token) +
                                    "&amount=" + encodeURIComponent(payload.amount) +
                                    "&transaction_id=" + encodeURIComponent(payload.idx);
                                xhr.send(data);
                            },
                            onError(error) {
                                console.log(error);
                            },
                            onClose() {
                                console.log('widget is closing');
                            }
                        }
                    };

                    var checkout = new KhaltiCheckout(config);
                    var btn = document.getElementById("payment-button");
                    btn.onclick = function () {
                        // minimum transaction amount must be 10, i.e 1000 in paisa.
                        checkout.show({ amount: 1000 });
                    }
                </script>

                <form method='post' action='cancel.php'>
                    <input type='hidden' name='appointment_id'
                        value='<?php echo $appointment_row['appointment_id']; ?>'>
                    <button type="submit" class="cancelButton">Cancel Appointment</button>
                </form>
            </div>
        </div>

    </div>
    <script>
        function printDiv() {
            var printContents = document.querySelector('.appointmentCard').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

</body>

</html>