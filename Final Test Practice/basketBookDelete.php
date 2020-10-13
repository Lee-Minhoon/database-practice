<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();

	$check_list = $_POST['check_hidden'];

	$query = "SELECT * FROM basket WHERE user_number = '$userNum'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$basketNum = $row['number'];
	}

	$query = "SELECT * FROM basket_has_book WHERE basket_number = '$basketNum'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$book_array[] = $row['book_number'];
	}
	
	for($index = 0; $index < count($book_array); $index++){
		if($check_list[$index]){
			$query = "DELETE FROM basket_has_book WHERE book_number = '$book_array[$index]'";
			mysqli_query($conn, $query);
		};
	}

	header('Location: /bookBasket.html');
	mysqli_close($conn);
?>