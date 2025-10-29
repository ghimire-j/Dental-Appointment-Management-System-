<?php
// Include database configuration
session_start();
include 'config.php';

$loggedIn = isset($_SESSION['valid']);

$userdetail = [];
if ($loggedIn) {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userdetail = mysqli_fetch_assoc($result);
    $userID = $userdetail['id']; // Assuming 'id' is the primary key for the user in the 'admin' table
} else {
    header("Location: signIn.php");
    exit;
}

// Get the payment details from the POST request and validate them
$token = isset($_POST['token']) ? $_POST['token'] : null;
$amounts = isset($_POST['amount']) ? $_POST['amount'] : null;
$transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;

if (!$token || !$amounts || !$transaction_id) {
    echo "Error: Missing payment details.";
    exit;
}

$amount = $amounts / 100;

// Prepare SQL statement to insert the payment details into the database
$sql = "INSERT INTO payments (email, user_id, transaction_id, token, payment_date, amount) VALUES (?, ?, ?, ?, NOW(), ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sisss", $email, $userID, $transaction_id, $token, $amount); // Assuming transaction_id and token are VARCHAR types

// Execute the statement
if ($stmt->execute()) {
    echo "Payment details inserted successfully.";
} else {
    // Error inserting payment details
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
