<?php
session_start();
include 'config.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Retrieve user ID based on email
$sql_user = "SELECT  name, Image FROM admin WHERE email = ?";
$stmt_user = mysqli_prepare($conn, $sql_user);
mysqli_stmt_bind_param($stmt_user, "s", $email);
mysqli_stmt_execute($stmt_user);
$result_user = mysqli_stmt_get_result($stmt_user);
$user = mysqli_fetch_assoc($result_user);

// $user_id = $user['id'];
$name = $user['name'];
$default_image = "../../Media/Default/default.jpg"; // Change this to the path of your static image
$profile = isset($user['Image']) ? htmlspecialchars($user['Image']) : $default_image; // Check if Image is set in user table, otherwise use default image

// Retrieve notifications for the logged-in user
$sql_notifications = "SELECT * FROM notification WHERE email = ? ORDER BY timestamp DESC";
$stmt = mysqli_prepare($conn, $sql_notifications);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result_notifications = mysqli_stmt_get_result($stmt);

// Count unread notifications
$sql_unread = "SELECT COUNT(*) AS unread_count FROM notification WHERE email = ? AND is_read = 0";
$stmt_unread = mysqli_prepare($conn, $sql_unread);
mysqli_stmt_bind_param($stmt_unread, "s", $email);
mysqli_stmt_execute($stmt_unread);
$result_unread = mysqli_stmt_get_result($stmt_unread);
$row_unread = mysqli_fetch_assoc($result_unread);
$unread_count = $row_unread['unread_count'];

// Update notification status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];
    $sql_update = "UPDATE notification SET is_read = 1 WHERE notification_id = ? AND email = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "is", $notification_id, $email);
    mysqli_stmt_execute($stmt_update);

    // Update unread count
    $sql_unread = "SELECT COUNT(*) AS unread_count FROM notification WHERE email = ? AND is_read = 0";
    $stmt_unread = mysqli_prepare($conn, $sql_unread);
    mysqli_stmt_bind_param($stmt_unread, "s", $email);
    mysqli_stmt_execute($stmt_unread);
    $result_unread = mysqli_stmt_get_result($stmt_unread);
    $row_unread = mysqli_fetch_assoc($result_unread);
    echo $row_unread['unread_count'];
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="stylesheet" href="inbox.css" />
    <title>Frontend Mentor | Notifications page</title>
    <style>
        body {
            background-image: url('images/bgImage.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
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
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="notif_box">
                <h2 class="title">Notifications</h2>
                <span id="notifes"><?php echo $unread_count; ?></span>
            </div>
            <p id="mark_all">Mark all as read</p>
            <a href="welcome.php" class="home-button">Home</a>
        </header>
        <main>
            <?php while ($notification = mysqli_fetch_assoc($result_notifications)): ?>
                <div class="notif_card <?php echo $notification['is_read'] ? 'read' : 'unread'; ?>"
                    data-notification-id="<?php echo $notification['notification_id']; ?>">
                    <img src="<?php echo $profile ?>" alt="avatar" />
                    <div class="description">
                        <p class="user_activity">
                            <strong><?php echo htmlspecialchars($name); ?></strong>
                            <?php echo htmlspecialchars($notification['message']); ?>
                        </p>
                        <p class="time"><?php echo htmlspecialchars($notification['timestamp']); ?></p>
                    </div>
                </div>
                <p>----------------------------------------------------------------------------------</p>
            <?php endwhile; ?>
        </main>
    </div>

    <script>
        const unreadMessages = document.querySelectorAll(".unread");
        const unread = document.getElementById("notifes");
        const markAll = document.getElementById("mark_all");

        unreadMessages.forEach((message) => {
            message.addEventListener("click", () => {
                message.classList.remove("unread");
                message.classList.add("read");
                const notificationId = message.getAttribute("data-notification-id");
                markNotificationAsRead(notificationId);
            });
        });

        markAll.addEventListener("click", () => {
            unreadMessages.forEach(message => {
                message.classList.remove("unread");
                message.classList.add("read");
                const notificationId = message.getAttribute("data-notification-id");
                markNotificationAsRead(notificationId);
            });
        });

        function markNotificationAsRead(notificationId) {
            fetch('notification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'notification_id=' + notificationId
            })
                .then(response => response.text())
                .then(data => {
                    unread.innerText = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>