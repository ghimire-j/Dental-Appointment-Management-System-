<?php
// // Include session start and necessary files
// session_start();
// require_once('config.php'); // Include your database connection configuration file

// // Check if payment is successful
// if (isset($_POST['token']) && !empty($_POST['token'])) {
//     // Retrieve appointment data from session
//     $appointment_data = $_SESSION['appointment_data'];

//     // Insert appointment data into database
//     $query = "INSERT INTO appointment_form (first_name, last_name, email, phone, Preferred_doctor, appointment_date, status) 
//               VALUES ('" . $appointment_data['first_name'] . "', '" . $appointment_data['last_name'] . "', '" . $appointment_data['email'] . "', 
//               '" . $appointment_data['phone'] . "', '" . $appointment_data['Preferred_doctor'] . "', '" . $appointment_data['appointment_date'] . "', 'booked')";

//     if (mysqli_query($conn, $query)) {
//         // If the data is successfully inserted, show a success message
//         echo "<script>alert('Appointment booked successfully!');</script>";
//         // Destroy session data after successful booking
//         unset($_SESSION['appointment_data']);
//     } else {
//         // If there is an error in the query, show an error message
//         echo "<script>alert('Error in booking appointment: " . mysqli_error($conn) . "');</script>";
//     }
// } else {
//     // If payment token is not received, redirect back to appointment form
//     header("Location: appointment_form.php");
//     exit(); // Ensure no further code execution after redirection
// }
?>

<html>
<head>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>
<body>
    ...
    <!-- Place this where you need payment button -->
    <button id="payment-button">Pay with Khalti</button>
    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_f5d5b56d3d174f3188fa75168b38766f",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>
    <!-- Paste this code anywhere in you body tag -->
    ...
</body>
</html>
