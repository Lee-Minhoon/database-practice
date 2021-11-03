<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	$number = $_POST['number'];
	$date = $_POST['date'];
	$kind = $_POST['kind'];

	if($number == null || $date == null || $kind == null){
		echo "<script>if(!alert('공백이 있습니다.')) document.location = '/creditRegister.html'</script>";
		exit();
	}

	$query = "SELECT * FROM credit WHERE number = '$number'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row >= 1){
		echo "<script>if(!alert('존재하는 카드입니다.')) document.location = '/creditRegister.html'</script>";
		exit();
	}

	header('Location: /credit.html');
	mysqli_query($conn, "INSERT INTO credit (number, user_number, date, kind) VALUES ('$number', '$userNum', '$date', '$kind')");
	mysqli_close($conn);
?>