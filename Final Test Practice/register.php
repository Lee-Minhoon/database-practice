<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	$name = $_POST['name'];
	$id = $_POST['id'];
	$pw = $_POST['pw'];
	$date = date("Y-m-d");

	if($name == null || $id == null || $pw == null){
		echo "<script>if(!alert('공백이 있습니다.')) document.location = '/register.html'</script>";
		exit();
	}

	$query = "SELECT * FROM user WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row >= 1){
		echo "<script>if(!alert('존재하는 ID입니다.')) document.location = '/register.html'</script>";
		exit();
	}

	header('Location: /login.html');
	mysqli_query($conn, "INSERT INTO user (name, id, pw) VALUES ('$name', '$id', '$pw')");
	$lastid = mysqli_insert_id($conn);
	mysqli_query($conn, "INSERT INTO basket (user_number, date) VALUES ('$lastid', '$date')");
	mysqli_close($conn);
?>