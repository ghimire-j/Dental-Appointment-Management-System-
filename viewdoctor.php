<?php
include 'config.php';

// Pagination settings
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch the total number of records
$total_result = $conn->query("SELECT COUNT(id) AS id FROM specialties");
$total_row = $total_result->fetch_assoc();
$total = $total_row['id'];
$pages = ceil($total / $limit);

// Fetch the specific page's data
$sql = "SELECT id, Doctor, email, sname FROM specialties LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specialties Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        body {
            background-image: url("images/bgImage.png");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .table-container {
            margin-top: 20px;
        }
        
         /* body {
            background-image: url('images/bgImage.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            opacity: 0.5;
        } */
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
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style="background-color:white; width:80%; margin: 0 auto; text-align:center;border-radius:10px;">
    <br>
        <h2 class="page-title">Doctors and Their Speciality</h2>
<br>
        <div class="container table-container" style="margin: 0 auto; text-align:center;">
            <table class="table table-hover" style="margin: 0 auto; text-align:center;">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Email</th>
                        <th scope="col">Specialty Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row["id"] . "</th>";
                            echo "<td>" . $row["Doctor"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["sname"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <a href="welcome.php" class="home-button">Home</a>
        </div>
    </div>
</body>

</html>