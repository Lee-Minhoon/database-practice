<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	$title = $_POST['title'];
	$price = $_POST['price'];

	if($title == null || $price == null){
		echo "<script>if(!alert('공백이 있습니다.')) document.location = '/bookRegister.html'</script>";
		exit();
	}

	$query = "SELECT * FROM book WHERE title = '$title'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($row >= 1){
		echo "<script>if(!alert('존재하는 책입니다.')) document.location = '/bookRegister.html'</script>";
		exit();
	}

	header('Location: /books.html');
	mysqli_query($conn, "INSERT INTO book (title, stock, price) VALUES ('$title', '0', '$price')");
	mysqli_close($conn);
?>