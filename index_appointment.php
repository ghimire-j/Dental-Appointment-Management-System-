<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign.css">
    <script src="https://kit.fontawesome.com/e29b4434c7.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Dental App</title>
</head>
<body>
<div class="container">
<script>
			swal({
				title: "Sorry!",
				text: "You have to log in to make appointments !",
				icon: "warning",
			}).then(function() {
				window.location.href = "index.php";   
			});
</script>
</div>  
</body>
</html>