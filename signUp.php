<?php
include('partials/header.php');

if (isset($_SESSION['accountCreated'])) {
    echo $_SESSION['accountCreated'];
    unset($_SESSION['accountCreated']);
}

// Database connection
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmedpassword = $_POST['confirmpassword'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $emailPattern = '/[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|heraldcollege\.edu.np|icloud\.com)/';

    $v_code = bin2hex(random_bytes(8));
    $v_code = hash("sha256", $v_code);

    if (preg_match($emailPattern, $email)) {
        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM `admin` WHERE `email`='$email'";
        $resultEmail = mysqli_query($conn, $checkEmailQuery);
        $numEmailRows = mysqli_num_rows($resultEmail);

        if ($numEmailRows > 0) {
            echo '<script>
            swal({
                title: "Error!",
                text: "Email already registered!",
                icon: "error",
            }).then(function() {
                window.location.href = "signUp.php";
            });
            </script>';
            exit;
        }

        // Insert query
        $sql = "INSERT INTO admin SET 
            name = '$name', 
            email = '$email',
            password = '$password',
            address = '$address',
            phone = '$phone',
            dob = '$dob',
            gender ='$gender',
            verification_code='$v_code',
            is_verified ='0'";

        // Execute the query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            // require_once('mailer.php');
            
            $mail->setFrom('jubingc15@gmail.com', 'Admin-Kathmandu Dental');
            $mail->addAddress($email);
            $mail->Subject = "Email verification From Kathmandu Dental";
            $mail->Body =  $mail->Body = <<<HTML
            <html>
            <head>
                <style>
                    body { font-family: "Segoe UI", Roboto, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                    .container { max-width: 600px; margin: auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
                    .header { background-color: #00e5ee;; color: #fff; padding: 20px; border-top-left-radius: 8px; border-top-right-radius: 8px; text-align: center; }
                    h2 { margin-top: 0; }
                    .content { padding: 20px; color: #555; }
                    .footer { background-color: #f4f4f4; padding: 10px 20px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
                    p { margin: 10px 0; }
                    a { color: #007bff; text-decoration: none; }
                    a:hover { text-decoration: underline; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h2>Activate Your Account</h2>
                    </div>
                    <div class="content">
                        <p>Dear User,</p>
                        <p>Thank you for registering. Please click the link below to activate your account:</p>
                        <p><a href="http://localhost/DAMS/verify.php?v_code=$v_code&email=$email">Activate Your Account</a></p>
                    </div>
                    <div class="footer">
                        <p>Best regards,<br>Kathmandu Dental</p>
                    </div>
                </div>
            </body>
            </html>
            HTML;

            try {
                $mail->send();
                echo "<script>
                    swal({
                        title: 'Success!',
                        text: 'Registration Successful. Please check your email to activate your account.',
                        icon: 'success',
                    }).then(function() {
                        window.location.href = 'signIn.php';
                    });
                </script>";
            } catch (Exception $e) {
                echo "<script>
                    swal({
                        title: 'Error!',
                        text: 'Message could not be sent. Mailer error: {$mail->ErrorInfo}',
                        icon: 'error',
                    }).then(function() {
                        window.location.href = 'signUp.php';
                    });
                </script>";
                exit;
            }
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
            echo "<script>
                swal({
                    title: 'Error!',
                    text: '{$errorMessage}',
                    icon: 'error',
                }).then(function() {
                    window.location.href = 'signUp.php';
                });
            </script>";
        }
    } else {
        echo "<script>
            alert('Please enter a valid email address with domain @gmail.com, @yahoo.com, or @outlook.com');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <div class="signUplogo">
                <img src="images/DENTAL APPOINTMENT SYSTEM (1).png" alt="">
            </div>
            <h1> Sign Up </h1>
            <form action="" method="POST">
                <div class="input-group">
                    <div class="input-field" id="name">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Full Name" name="name" pattern="[A-Za-z\s]{3,30}"
                            title="Please enter a valid name (3-30 characters)" required>
                    </div>

                    <div class="input-field" id="email">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email"
                            pattern="[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|outlook\.com|icloud\.com)"
                            title="Please enter a valid email address with domain @gmail.com, @yahoo.com, @outlook.com, or @icloud.com"
                            required>
                    </div>

                    <div class="input-field" id="password">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="password"
                            pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()-_=+[\]{};:',.<>?]).{8,}$"
                            title="Invalid Password" required>
                    </div>

                    <div class="input-field" id="address">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" placeholder="Address" name="address" required>
                    </div>

                    <div class="input-field" id="phone">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" placeholder="Phone Number" name="phone" pattern="98\d{8}"
                            title="Please enter a valid 10-digit phone number starting with 98" required>
                    </div>

                    <div class="input-field" id="dob">
                        <p style="font-size: 12px; margin-left: 15px; color: #999;"><b>DOB</b></p>
                        <input type="date" placeholder="Date of Birth" name="dob" required>
                    </div>

                    <div class="input-field" id="gender">
                        <label for="gender">Gender:</label>
                        <input type="radio" name="gender" value="female">Female
                        <input type="radio" name="gender" value="male">Male
                        <input type="radio" name="gender" value="other">Other
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn" name="signup"><b>Sign Up</b></button>
                </div>

                <span class="signinLink">Have an account already? <a href="signIn.php">Login</a></span>
            </form>
        </div>
    </div>
</body>

</html>
