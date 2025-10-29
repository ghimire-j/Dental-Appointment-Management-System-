<?php
$connect = new PDO("mysql:host=localhost:3306;dbname=login_db", "root", ",Heraldcollege@1");

if(isset($_POST["rating_data"]))
{
	$data = array(
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	date('Y-m-d')
	);

	$query1 = "UPDATE review_table SET status = NULL WHERE Status = 'Last'";
	$statement1 = $connect->prepare($query1);
	$statement1->execute();

	$query2 = "INSERT INTO review_table 
			(user_name, user_rating, user_review, datetime, Status) 
			VALUES (:user_name, :user_rating, :user_review, :datetime, 'Last')";
	$statement2 = $connect->prepare($query2);
	$statement2->execute($data);

	$query3 = "SELECT id FROM review_table WHERE Status = 'Last'";
	$statement3 = $connect->prepare($query3);
	$statement3->execute();
	$result = $statement3->fetch(PDO::FETCH_ASSOC);
	$to = $result["id"];

	$query4 = "SELECT user_rating FROM review_table WHERE id = :id";
	$statement4 = $connect->prepare($query4);

	$a = 0;
	for ($x = 1; $x <= $to; $x++)
	{
		$statement4->bindParam(':id', $x, PDO::PARAM_INT);
		$statement4->execute();
		$result = $statement4->fetch(PDO::FETCH_ASSOC);
		$a += $result["user_rating"];
	}

	$average_rating = $a / $to;
	echo $average_rating;
}
?>
