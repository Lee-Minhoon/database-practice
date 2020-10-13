<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();

	$check_list = $_POST['check_hidden'];

	$query = "SELECT * FROM orders WHERE user_number = '$userNum'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$historyNumber[] = $row['number'];
	}

	for($index = 0; $index < count($historyNumber); $index++){
		if($check_list[$index]){
			$query = "DELETE FROM order_has_book WHERE order_number = '$historyNumber[$index]'";
			mysqli_query($conn, $query);
			$query = "DELETE FROM orders WHERE number = '$historyNumber[$index]'";
			mysqli_query($conn, $query);
		};
	}
	header('Location: /bookHistory.html');
	mysqli_close($conn);
?>