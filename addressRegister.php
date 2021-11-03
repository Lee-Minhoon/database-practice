<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	$base = $_POST['base'];
	$detail = $_POST['detail'];
	$zipcode = $_POST['zipcode'];

	if($base == null || $detail == null || $zipcode == null){
		echo "<script>if(!alert('공백이 있습니다.')) document.location = '/addressRegister.html'</script>";
		exit();
	}

	$query = "SELECT * FROM user_has_address WHERE user_number = '$userNum' AND address_base = '$base' AND address_detail = '$detail'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row >= 1){
		echo "<script>if(!alert('이미 존재하는 개인 배송지입니다.')) document.location = '/addressRegister.html'</script>";
		exit();
	}

	$query = "SELECT * FROM address WHERE base = '$base' AND detail = '$detail'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row >= 1){
		echo "<script>if(!alert('개인 배송지로 등록 되었지만, 사이트에 존재하는 배송지입니다.')) document.location = '/address.html'</script>";
		mysqli_query($conn, "INSERT INTO user_has_address (user_number, address_base, address_detail) VALUES ('$userNum', '$base', '$detail')");
	}else{
		header('Location: /address.html');
		mysqli_query($conn, "INSERT INTO address (base, detail, zipcode) VALUES ('$base', '$detail', '$zipcode')");
		mysqli_query($conn, "INSERT INTO user_has_address (user_number, address_base, address_detail) VALUES ('$userNum', '$base', '$detail')");
		mysqli_close($conn);
	}
?>