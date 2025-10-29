<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Your Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f0f0;
        }

        form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            width: 350px;
            border-radius: 5px;
            padding: 20px 25px 30px 25px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #2f66d4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #1c3faa;
        }
    </style>
</head>

<body>
    <?php
    require("config.php");

    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kathmandu');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `admin` WHERE `email`='{$_GET['email']}' AND `resettoken`='{$_GET['reset_token']}' AND `resettokenexpire` >= '$date'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                echo "
                <form method='POST' id='updateForm'>
                <h2> Create new Password</h2>
                <input type='password' placeholder='Enter New Password' name='Password'>
                <button type='submit' name='updatepassword'> UPDATE</button>
                <input type='hidden' name='email' value='{$_GET['email']}'>
                </form>
                ";

            } else {
                echo "
            <script> 
                alert('Invalid or Expired Link');
                window.location.href = 'signIn.php';
            </script>";
            }
        } 
        else 
        {
            echo "
            <script> 
                alert('Error! Try again later');
                window.location.href = 'signIn.php';
            </script>";
        }
    }
    ?>

    <?php
    if (isset($_POST['updatepassword']))
    {
        $pass = $_POST['Password'];
        // $pass=password_hash($_POST['Password'], PASSWORD_BCRYPT);
        $update="UPDATE `admin` SET `password`='$pass',`resettoken`= NULL,`resettokenexpire`= NULL WHERE `email`='{$_POST['email']}' ";
        if(mysqli_query($conn, $update)){
            echo "<script> 
                alert('Your Password Has been Updated Successfully!!');
                window.location.href =''signIn.php;
            </script>";
        }else{
            echo "<script> 
                alert('Error! Try again later');
                window.location.href= 'index.php';
            </script>";
        }
    }
    ?>

    <!-- <script>
        document.getElementById("updateForm").addEventListener("submit", function(event){
            alert('Your Password Has been Updated Successfully!!');
            window.location.href ='signIn.php';
        });
    </script> -->
</body>

</html>
