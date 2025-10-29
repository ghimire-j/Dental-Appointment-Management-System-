<?php
require ('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require ('phpmailer/src/Exception.php');
require ('phpmailer/src/PHPMailer.php');
require ('phpmailer/src/SMTP.php');
function sendMail($email, $reset_token)
{

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jubingc15@gmail.com';
        $mail->Password = 'siqr dqze bdap bomk';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('jubingc15@gmail.com', 'ADMIN');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Pasword Reset Link from KATHMANDU DENTAL';
        $mail->Body = "We got a request from you to reset your password!! <br>
            CLick the link below: <br>
            <a href='http://localhost/DAMS/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";

        $mail->send();
        return true;

    } catch (Exception $e) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    }
}
if (isset($_POST['reset'])) {
    // Retrieve email address from form
    $email = $_POST['email'];
    // Check if email exists in the database
    $query = "SELECT * FROM admin WHERE email = '$_POST[email]'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $reset_token = bin2hex(random_bytes(8));
            date_default_timezone_set('Asia/kathmandu');
            $date = date("Y-m-d");
            $query = "UPDATE admin SET resettoken='$reset_token', resettokenexpire='$date' WHERE email='$_POST[email]'";
            if (mysqli_query($conn, $query) && sendMail($_POST['email'], $reset_token)) {
                echo "
                <script> 
                alert('Password reset lnk has been sent to mail');
                </script>
                ";


            } else {
                echo "
                <script> 
                alert('Error!Try again later');
                </script>
                ";
            }


        } else {
            echo "
                <script> 
                alert('email not registered');
                </script>
                ";

        }

    } else {
        echo "
        <script> 
        alert('cannot run query');
        </script>
        ";
        // $msg = "Email does not exist";
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|Forget Password|</title>
    <link rel="stylesheet" href="forgot_password.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background-image: url('images/bgImage.png') !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        h1#sys_title {
            font-size: 6em;
            text-shadow: 3px 3px 10px #000000;
        }

        @media (max-width: 700px) {
            h1#sys_title {
                font-size: inherit !important;

            }
        }

        .card.my-3.col-md-4.offset-md-4 {
            opacity: 1;
        }

        .cta {
            background: #f2f2f2;
            width: 100%;
            padding: 15px 40px;
            box-sizing: border-box;
            color: #666666;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="form-box9">
            <div class="signInlogo">
                <img src="images/DENTAL APPOINTMENT SYSTEM (1).png" alt="">
            </div>
            <h1 align="center">Forgot Password</h1><br />
            <form id="validate_form" method="post">
                <div class="input-group2">
                    <div class="input-field">
                        <input type="text" name="email" id="email" placeholder="Enter your email address" required
                            data-parsley-type="email" data-parsley-trigger="keyup" class="form-control">
                    </div> <br>
                    <div class="btn-field2">
                        <button type="submit" id="reset" name="reset" value="Continue">Reset Password</button>
                    </div>

                    <!-- <div class="btn-field2">
                        <button type="submit" id="log" name="reset" value="Continue">Login</button>
                        <button type="submit" id="reg" name="reset" value="Continue">Register</button>
                    </div> -->

                    <div class="btn-field2">
                        <a href="signIn.php" id="log">Login</a>
                        <span class="spacer"></span>
                        <a href="signUp.php" id="reg">Register</a>
                    </div>



            </form>
            <!-- <div class="d-flex">
                <a class="lo" href="signIn.php">Login</a>
                <a class="re" href="SignUp.php">Register</a>

            </div> -->
        </div>
    </div>
</body>

</html>