<?php
session_start();
include 'config.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: signIn.php");
    exit();
}

$email = $_SESSION['email'];
// Fetch user details from the database
$sql = "SELECT * FROM admin WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $userdetail = mysqli_fetch_assoc($result);
} else {
    // Handle error if user details are not found
    header("Location: error.php"); // Redirect to error page
    exit();
}


// Handle form submission
$updateMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update profile picture if uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profilePicture = $_FILES['profile_picture'];
        $targetDirectory = 'User_profile/';
        $targetFile = $targetDirectory . basename($profilePicture['name']);

        // Check file type
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $updateMessage = "Sorry, only JPG, JPEG, PNG files are allowed.";
        } else {
            // Move uploaded file to target directory
            if (move_uploaded_file($profilePicture['tmp_name'], $targetFile)) {
                $profilePicturePath = $targetFile;

                // Update profile picture path in database
                $updateImageSQL = "UPDATE admin SET Image = '$profilePicturePath' WHERE email = '$email'";
                if (mysqli_query($conn, $updateImageSQL)) {
                    $updateMessage = "Profile picture updated successfully.";
                } else {
                    $updateMessage = "Error updating profile picture: " . mysqli_error($conn);
                }
            } else {
                $updateMessage = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update other profile information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];

    // Update the user's profile in the database
    $updateProfileSQL = "UPDATE admin SET  name = '$name', address = '$address', phone = '$phone',dob ='$dob'  WHERE email = '$email'";
    if (mysqli_query($conn, $updateProfileSQL)) { 
        // $updateMessage = "Profile updated successfully.";
        // Fetch updated user details
        $updatedResult = mysqli_query($conn, $sql);
        if ($updatedResult && mysqli_num_rows($updatedResult) > 0) {
            $userdetail = mysqli_fetch_assoc($updatedResult);
            echo "<script>
            swal({
                title: 'Success!',
                text: 'Profile updated successfully.',
                icon: 'success',
            }).then(function() {
                window.location.href = welcome.php; // Stay on the same page
            });
            </script>";
        } else {
            $updateMessage .= " Error fetching updated details.";
        }
    } else {
        $updateMessage = "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editprofile.css">
    <link rel="stylesheet" href="style.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
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
    <div class="form-box1" style="font-size:larger;">
        <h2 style="text-align:center;  font-size:x-large;"> Edit Profile</h2> <br>
        <a href="welcome.php" class="home-button">Home</a>
        <?php if (!empty($updateMessage)): ?>
            <div class="message"><?php echo $updateMessage; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="profile-picture">
                <?php if ($userdetail['Image'] !== null): ?>
                    <img id="profile-image"
                        src="<?php echo $userdetail['Image'] ? $userdetail['Image'] : 'Image/default.jpg'; ?>"
                        alt="Profile Picture">
                    <input type="file" name="profile_picture" id="profile-picture-input" style="display: none;"
                        onchange="displaySelectedImage(event)">
                <?php else: ?>
                    <img src="Image/default.jpg" alt="User Logo" style="width: 100px; height: 100px;">
                    <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                            onchange="this.form.submit()">
                        <button type="button" onclick="document.getElementById('profile_picture').click()">upload</button>
                    </form>
                <?php endif; ?>

                <button type="button" class="btn"
                    onclick="document.getElementById('profile-picture-input').click()">Change Profile
                    Picture</button>
            </div>
            <div class="profile-info">
                <label for="fullname">Full Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $userdetail['name']; ?>">

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $userdetail['address']; ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $userdetail['email']; ?>" readonly>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $userdetail['phone']; ?>">

                <label for="dob">Date of birth:</label>
                <input type="text" id="dob" name="dob" value="<?php echo $userdetail['dob']; ?>">

            </div>
            <button type="submit">Save</button>
        </form>
    </div>

    <script>
        function displaySelectedImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var image = document.getElementById('profile-image');
                image.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    

    <pre>





</pre>
</body>

</html>