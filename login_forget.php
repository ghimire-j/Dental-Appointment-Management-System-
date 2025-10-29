<?php
include('partials/header.php');
require_once('config.php' );

if(isset($_POST['login'])){
    // echo 'your data submited';

    //creating variables to store email and password
    // $email = $_POST['email'];
    $password = $_POST['password'];
    
    //sql to select if there is the deatails in the database
    $sql = "SELECT * FROM admin WHERE password = '$password'";
    //excute the query
    $result = mysqli_query($conn, $sql);

    //count the number of account with same email and passwprd
    $count = mysqli_num_rows($result);
    //put the count result into one associate array
    $row = mysqli_fetch_assoc($result);

    if($count == 1){
        //message to welcome admin to home
        $_SESSION['loginMessage'] = '<span class="success">Welcome '.$password.' </span>';
        header('location:' .SITEURL. 'welcome.php');
        exit();
    }
    else{
        //message to welcome admin to home
        // $_SESSION['noAdmin'] = '<span class="fail">'.$password.' is not registered! </span>';
        // header('location:' .SITEURL. 'error');
        echo"<div class= 'alert alert-danger'style='  position: absolute;
        top: 63.5%;
        left: 45%;
        color: red;'> Incorrect Password . </div>";
        exit();
    }
}
?>  


<div class="container1">
<div class="form-box9">
<div class="signInlogo">
            <img src="images/DENTAL APPOINTMENT SYSTEM (1).png" alt="">
        </div>
            <h1>Forget Password</h1>
            <form action="" method="POST">
                <?php
                if(isset($_SESSION['noAdmin'])){
                    echo $_SESSION['noAdmin'];
                    unset($_SESSION['noadmin']);
                }
                ?>

<!-- form input -->
                <div class="input-group1">
                
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Enter new given password" name="password" required style="height:62%" />
                    </div>
                </div>
                <div class="btn-field1">
                    <button type="login" id="signinBtn" name="login" style="margin-top: -23%;"><b>Login</b></button>
                </div>
        </form>
    </div>
</div>
<script src="sign.js"></script>

