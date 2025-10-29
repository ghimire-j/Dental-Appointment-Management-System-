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

// Define variables for search
$search = '';

// Process search input
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Construct the SQL query to fetch appointments for the searched doctor
    $sql = "SELECT appointment_id, first_name, last_name, email, appointment_date, preferred_doctor, status
            FROM appointment_form
            WHERE preferred_doctor IS NOT NULL AND preferred_doctor LIKE '%$search%'";
} else {
    // Construct the SQL query to fetch all appointments
    $sql = "SELECT appointment_id, first_name, last_name, email, appointment_date, preferred_doctor, status
            FROM appointment_form
            WHERE preferred_doctor IS NOT NULL";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e29b4434c7.js" crossorigin="anonymous"></script>
    <title>Dental App</title>
   <style>
        body {
            background-image: url("images/bgImage.png");
            background-repeat: no-repeat;
            /* background-size: cover; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px 60px 70px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            max-width: 90%;
        }
        .home-button {
            background-color: #2f66d4;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin: 10px 0;
            text-decoration: none;
            position: absolute;
            /* top: 223px;
            left: 142px; */
            top: 30px;
            left: 140px;
        }

        .container form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4" style="text-transform: uppercase;">Schedule</h1>
        <br>
        <a href="doctor_welcome.php" class="home-button">Home</a>

        <!-- Search form -->
        <form class="mb-4" action="" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by doctor name" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>

        <!-- Display appointments -->
        <?php
        // Output HTML table
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-hover'>";
            echo "<thead class='table-primary'>
                <tr>
                    <th>Appointment ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
                </thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>" . $row["appointment_id"] . "</td>
                <td>" . $row["first_name"] . "</td>
                <td>" . $row["last_name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["appointment_date"] . "</td>
                <td>" . $row["preferred_doctor"] . "</td>
                <td>" . $row["status"] . "</td>
                </tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p class='text-center'> Search by Doctor's Name.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
    
</body>

</html>
