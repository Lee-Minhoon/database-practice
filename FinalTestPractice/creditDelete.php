<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();

	$check_list = $_POST['check_hidden'];

	$query = "SELECT * FROM credit WHERE user_number = '$userNum'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$card_array[] = $row['number'];
	}
	
	for($index = 0; $index < count($card_array); $index++){
		if($check_list[$index]){
			$query = "DELETE FROM credit WHERE number = '$card_array[$index]'";
			mysqli_query($conn, $query);
		};
	}
	header('Location: /credit.html');
	mysqli_close($conn);
?>