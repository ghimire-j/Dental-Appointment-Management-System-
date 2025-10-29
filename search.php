<?php
// Start a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once('config.php');

// Check if the form has been submitted
if(isset($_POST['search'])) {
    // Get the appointment ID from the form data
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
    
    // perform a database query to fetch the appointment data
    $query = "SELECT * FROM appointment_form WHERE appointment_id = '$appointment_id'";
    $result = mysqli_query($conn, $query);
    
    // Check if the query returned any results
    if(mysqli_num_rows($result) > 0) {
         // Generate invoice HTML
         $appointment_row = mysqli_fetch_assoc($result);
         $invoice_html = "<html><head><style> 
            body {
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                font-family: Arial, sans-serif;
                color: #333;
            }
            .content {
                width: 80%;
                margin: 0 auto;
                text-align: center;
            }
            .invoice {
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .invoice table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }
            .invoice th, .invoice td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
            }
            .invoice th {
                background-color: #f2f2f2;
            }
            .print-button, .home-button {
                background-color: #2f66d4;
                color: white;
                width: 200px;
                font-size: 16px;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 10px;
                margin-left:40%;
            }
            .print-button {
                margin-left: 40%;
            }
            .home-button {
                margin-top: 20px;
            }
         </style></head><body>";
         $invoice_html .="<div class='content'>";
         $invoice_html .= "<div class='invoice'>";
         $invoice_html .= "<img src='images/logo.png' alt='Hospital Logo' style='display: block; margin: 0 auto;'>";
         $invoice_html .= "<h3>Kathmandu Dental</h3>";
         $invoice_html .= "<h2>Appointment Invoice</h2>";
         $invoice_html .= "<table>";
         $invoice_html .= "<tr><th>Appointment ID:</th><td>".$appointment_row['appointment_id']."</td></tr>";
         $invoice_html .= "<tr><th>First Name:</th><td>".$appointment_row['first_name']."</td></tr>";
         $invoice_html .= "<tr><th>Last Name:</th><td>".$appointment_row['last_name']."</td></tr>";
         $invoice_html .= "<tr><th>Email:</th><td>".$appointment_row['email']."</td></tr>";
         $invoice_html .= "<tr><th>Phone:</th><td>".$appointment_row['phone']."</td></tr>";
         $invoice_html .= "<tr><th>Preferred Doctor:</th><td>".$appointment_row['Preferred_doctor']."</td></tr>";
         $invoice_html .= "<tr><th>Symptoms:</th><td>".$appointment_row['Symptoms']."</td></tr>";
         $invoice_html .= "</table>";
         $invoice_html .= "<br><button onclick='printDiv()' class='print-button'>Print Invoice</button>";
         $invoice_html .= "<form action='welcome.php' method='post'><button class='home-button'>Home</button></form>";
         $invoice_html .= "</div></div></body></html>";
         $invoice_html .= "<script>
                     function printDiv() {
                         var printContents = document.querySelector('.invoice').innerHTML;
                         var originalContents = document.body.innerHTML;
                         document.body.innerHTML = printContents;
                         window.print();
                         document.body.innerHTML = originalContents;
                     }
                   </script>";
 
         // Output the invoice HTML
         echo $invoice_html;
     } else {
        // If no, display an error message
        echo "<script>alert('No appointment found with ID: " . $appointment_id . "');</script>";
        echo "<script>window.location.href = 'admin_welcome.php';</script>";
    }
}
?>
