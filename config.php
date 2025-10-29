<?php

// session_start(); // Uncomment if needed

// Creating constants to store localhost, root, password, and database details
define('LOCALHOST', 'localhost');             
define('ROOT', 'root');
define('PASSWORD', ',Heraldcollege@1'); 
define('DATABASE', 'login_db');
define('SITEURL', 'http://localhost/DAMS/'); 

// Establishing the database connection
$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) 
    or die("Connection failed: " . mysqli_connect_error());

// Selecting the database
$db_select = mysqli_select_db($conn, DATABASE) 
    or die("Database selection failed: " . mysqli_error($conn));

?>
