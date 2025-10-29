<?php
include('partials/header.php');
session_start();

if(isset($_POST['login'])){

    //creating variables to store email and password
    $email = $_POST['email'];
    $_SESSION['email'] = $email; 
    // $id = $_SESSION['id'];
// echo($_SESSION['email']);
    $passWord = $_POST['password'];
    // $password = password_hash($passWord, PASSWORD_DEFAULT);


    //sql to select if there is the deatails in the database
    $sql = "SELECT * FROM admin WHERE email = '$email' AND is_verified = 1 AND password = '$passWord'";
    //excute the query
    $result = mysqli_query($conn, $sql);
    // $result_fetch=mysqli_fetch_assoc($result);
        //count the number of account with same email and passwprd
        $count = mysqli_num_rows($result); 
        //put the count result into one associate array
        $row = mysqli_fetch_assoc($result);


// Check if the query was successful and if there is at least one row returned
// if ($result && mysqli_num_rows($result) > 0) {
//     // Fetch the first row from the result set as an associative array
//     $row = mysqli_fetch_assoc($result);
//     // Set $_SESSION['valid'] to the email from the fetched row
//     $_SESSION['valid'] = $row['email'];
// }

    // echo $password;

    if($count == 1){
        if($email == "jubingc15@gmail.com") {
            // $row["user_type"] == "admin"
            echo "<script>
                swal({
                    title: 'Success!',
                    text: 'You have logged in successfully!',
                    icon: 'success',
                }).then(function() {
                    window.location.href = 'http://localhost/edoc-doctor-appointment-system-main/admin/index.php';
                });
            </script>";
            $_SESSION['valid']='valid';
        } elseif ($email == "doctor@gmail.com") {
            echo "<script>
                swal({
                    title: 'Success!',
                    text: 'You have logged in successfully!',
                    icon: 'success',
                }).then(function() {
                    window.location.href = 'doctor_welcome.php';
                });
            </script>";
            $_SESSION['valid']='valid';
        } else {
            echo "<script>
                swal({
                    title: 'Success!',
                    text: 'You have logged in successfully!',
                    icon: 'success',
                }).then(function() {
                    window.location.href = 'welcome.php';
                });
            </script>";
            $_SESSION['valid']='valid';
        }
        exit();
    } else {
        echo "<script>
                swal({
                    title: 'Error!',
                    text: 'Invalid Email or Password!',
                    icon: 'error',
                }).then(function() {
                    window.location.href = 'signIn.php';
                });
            </script>";
        exit();
    }
}
?>


<div class="container1">
<div class="form-box1">
<div class="signInlogo">
            <img src="images/DENTAL APPOINTMENT SYSTEM (1).png" alt="">
            
        </div>
            <h1>Sign In</h1>
            <form action="" method="POST">
                <?php
                if(isset($_SESSION['noAdmin'])){
                    echo $_SESSION['noAdmin'];
                    unset($_SESSION['noAdmin']);
                }
                ?>
                <div class="input-group1">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" placeholder="Email" name="email" id ="email" required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <span class="forget"><a href="forget-password.php"> Forget Password? </a></span>
                </div>
                <div class="btn-field1">
                    <button type="login" id="signinBtn" name="login" required><b>Login</b></button>
                </div>
                <span class="signupLink">Don't have an account? <a href="signUp.php">Sign Up</a></span>     
        </form>
    </div>
</div>
<script src="sign.js"></script>
