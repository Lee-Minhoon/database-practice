<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();

	$check_list = $_POST['check_hidden'];

	$query = "SELECT * FROM user_has_address WHERE user_number = '$userNum'";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$userNumber[] = $row['user_number'];
		$baseAddress[] = $row['address_base'];
		$detailAddress[] = $row['address_detail'];
	}
	
	for($index = 0; $index < count($userNumber); $index++){
		if($check_list[$index]){
			$query = "DELETE FROM user_has_address WHERE user_number = '$userNumber[$index]' AND address_base = '$baseAddress[$index]' AND address_detail = '$detailAddress[$index]'";
			mysqli_query($conn, $query);
		};
	}
	header('Location: /address.html');
	mysqli_close($conn);
?>