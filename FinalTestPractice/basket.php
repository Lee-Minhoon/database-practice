<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	session_start();
	$userNum = $_SESSION['userNum'];
	$check_list = $_POST['check_hidden'];

	$query = "SELECT * FROM book";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$number[] = $row['number'];
		$price[] = $row['price'];
	}

	$query = "SELECT * FROM basket WHERE user_number = '$userNum'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$basket_number = $row['number'];

	for($index = 0; $index < count($number); $index++){
		if($check_list[$index]){
			mysqli_query($conn, "INSERT INTO basket_has_book (basket_number, book_number, price) VALUES ('$basket_number', '$number[$index]', '$price[$index]')");
		}
	}
	header('Location: /bookBasket.html');
	mysqli_close($conn);
?>