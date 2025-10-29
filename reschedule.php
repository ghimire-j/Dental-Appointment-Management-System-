<div style="text-align: center;">
    <?php
    session_start();

    // // Check if the appointment ID is set in the session
// if (!isset($_SESSION['appointment_id'])) {
//     echo "Error: Appointment ID not set in session.";
//     exit();
// }
    

    // Connect to the database
    require_once ('config.php');

    if (isset($_POST['reschedule'])) {
        // Assuming you have received POST data from the form
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $appointment_date = $_POST['appointment_date'];
        $problem = $_POST['problem'];
        $Preferred_doctor = $_POST['Preferred_doctor'];

        // $_SESSION['first_name'] = $first_name;
        // $_SESSION['last_name'] = $last_name;
        // $_SESSION['email'] = $email;
        // $_SESSION['phone'] = $phone;
        // $_SESSION['Preferred_doctor'] = $preferred_doctor;
        // $_SESSION['appointment_date'] = $appointment_date;
        // $_SESSION['symptoms'] = $Symptoms;
    
        // Check which form action was triggered
        // Booking an appointment
        $stmt = $conn->prepare("SELECT appointment_id FROM appointment_form WHERE first_name = ? AND last_name = ? AND email = ? AND phone = ? AND appointment_date = ? AND Symptoms = ? AND Preferred_doctor = ?");
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $appointment_date, $problem, $Preferred_doctor);

        // Execute the statement
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($appointment_id);

        // Fetch the result
        if ($stmt->fetch()) {
            echo "Appointment ID: " . $appointment_id;
            $_SESSION['appointment_id'] = $appointment_id;
        } else {
            $_SESSION['appointment_id'] = '';
            echo "<script>
            swal({
                title: 'Error!',
                text: 'Incorrect credentials',
                icon: 'error',
            }).then(function() {
                window.location.href = 'welcome.php';
            });
        </script>";        }

        // Close the statement
        $stmt->close();
        // $email = $_SESSION['email'];

        // } elseif (isset($_POST['reschedule'])) {
        //     // Redirect to reschedule page
        //     header('Location: reschedule.php');
        //     exit();
        // } elseif (isset($_POST['cancel'])) {
        // // Canceling an appointment
        // $stmt = $conn->prepare("DELETE FROM appointment_form WHERE first_name = ? AND last_name = ? AND email = ? AND phone = ? AND appointment_date = ? AND problem = ? AND Preferred_doctor = ?");
        // $stmt->bind_param("sssssss", $first_name, $last_name, $email, $phone, $appointment_date, $problem, $Preferred_doctor);
    
        // // Execute the statement
        // if ($stmt->execute()) {
        //     echo "Appointment canceled successfully.";
        // } else {
        //     echo "Failed to cancel appointment.";
        // }
    
        // Close the statement
        // $stmt->close();
    
        // Close the connection
        $conn->close();
    }



    // echo $appointment_id ;
    
    // Check if the form has been submitted

    ?>

    <html>

    <head>
        <title>Reschedule Appointment</title>

        <style>
            body {
                background-image: url(images/bgImage.png);
                background-position: center;
                background-size: cover;

            }

            .home-button {
                background-color: #2f66d4;
                color: white;
                cursor: pointer;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                text-align: center;
                display: inline-block;
                margin: 10px 0;
                text-decoration: none;
            }

            .container {

                height: 42vh;
                border-radius: 14px;
                width: 90%;
                max-width: 450px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #ffffff;
                opacity: 90%;
                padding: 50px 60px 70px;
                text-align: center;
            }

            label {
                display: inline-block;
                width: 200px;
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }

            input[type="date"] {
                width: 200px;
                font-size: 1.2rem;
                padding: 0.5rem;
            }

            input[type="submit"],
            input[type="button"] {
                margin-top: 1rem;
                display: inline-block;
                padding: 1rem 3rem;
                border-radius: 0.5rem;
                font-size: 1.2rem;
                color: white;
                width: 180px;
            }

            input[type="submit"] {
                background: #2f66d4;
                font-size: small;
                font-weight: bold;
            }

            input[type="button"] {
                background-color: #2f66d4;
                font-size: small;
                font-weight: bold;
            }

            input[type="submit"]:hover,
            input[type="button"]:hover {
                background-color: #45a049;
            }

            input[type="submit"]:focus,
            input[type="button"]:focus {
                outline: none;
            }

            input[type="submit"]:active,
            input[type="button"]:active {
                background-color: #2f66d4;
            }
        </style>
    </head>

    <body>
       


        <div class="container">
        <a href="welcome.php" class="home-button">Home</a>
            <h2>Reschedule Appointment</h2>
            <p>Current appointment date: <?php echo $appointment_date; ?></p>
            <form method="POST" action="reschedule_process.php" onsubmit="return validateAppointment();">
                <label for="new_date">New appointment date:</label>
                <input type="datetime-local" name="new_date" required>
                <br><br>
                <input type="submit" value="Reschedule" onclick="return validateAppointment();"
                >
                <input type="button" value="Cancel" onclick="window.location.href='cancel.php' ">
                <br>

                <!-- <input type="button" value="Ok"
                    onclick="window.location.href='reschedule_process.php'; alert('Your appointment has been booked.');"> -->
            </form>
        </div>
        <script>
            function validateAppointment() {
                var newDateInput = new Date(document.getElementsByName("new_date")[0].value);
                var currentDate = new Date();

                // Compare new appointment date with current date
                if (newDateInput < currentDate) {
                    alert("Please select a future date and time for your appointment.");
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }
        </script>
    </body>

    </html>