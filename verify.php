<?php
session_start();
include('partials/header.php');

if(isset($_GET['email']) && isset($_GET['v_code']))
{
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];

    $query = "SELECT * FROM `admin` WHERE `email`='$email' AND `verification_code`='$v_code'";
    $result = mysqli_query($conn, $query);

    // echo "Email: " . htmlspecialchars($email) . "<br>";
    // echo "Verification Code: " . htmlspecialchars($v_code) . "<br>";
    
    if($result && mysqli_num_rows($result) == 1)
    {
        $result_fetch = mysqli_fetch_assoc($result);
        
        if($result_fetch['is_verified'] == 0)
        {
            $update = "UPDATE `admin` SET `is_verified`='1' WHERE `email`='$email'";
            
            if(mysqli_query($conn, $update))
            {
                echo '<script>
                        // Show success message and redirect
                        swal({
                            title: "Success!",
                            text: "Email Verification Successful!",
                            icon: "success",
                        }).then(function() {
                            window.location.href = "signIn.php";
                        });
                    </script>';
            }
            else
            {
                echo '<script>
                        // Show error message and redirect
                        swal({
                            title: "Error!",
                            text: "Cannot run query.",
                            icon: "error",
                        }).then(function() {
                            window.location.href = "verify.php";
                        });
                    </script>';
            }
        }
        else
        {
            echo '<script>
                    // Show error message and redirect
                    swal({
                        title: "Error!",
                        text: "Email already Verified.",
                        icon: "error",
                    }).then(function() {
                        window.location.href = "verify.php";
                    });
                </script>';
        }
    }
    else
    {
        echo '<script>
                // Show error message and redirect
                swal({
                    title: "Error!",
                    text: "Your account is created but not verified. Please check your email for verification.",
                    icon: "error",
                }).then(function() {
                    window.location.href = "verify.php";
                });
            </script>';
    }
}
?>
