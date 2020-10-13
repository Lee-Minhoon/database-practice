<?php
	session_start();
	$userNum = $_SESSION['userNum'];
	include $_SERVER["DOCUMENT_ROOT"]."/include/connectDB.php";
	$conn = db_connect();
	$count_list = $_POST['count_list'];

	for($index = 0; $index < count($count_list); $index++){
		if($count_list[$index] > 5){
			echo "<script>if(!alert('5점까지만 입력가능합니다.')) document.location = '/bookRegister.html'</script>";
			exit();
		}
	}

	$query = "SELECT * FROM book";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result)){
		$book_id[] = $row['number'];
		$book_star[] = $row['star'];
		$book_num[] = $row['starNum'];
	}

	for($index = 0; $index < count($count_list); $index++){
		if($count_list[$index] > 0){
			$book_star[$index] += $count_list[$index];
			$book_num[$index] ++;
			mysqli_query($conn, "UPDATE order_has_book SET star = '$book_star[$index]' WHERE number = '$book_id[$index]'");
			mysqli_query($conn, "UPDATE order_has_book SET starNum = '$book_num[$index]' WHERE number = '$book_id[$index]'");
		}
	}

	header('Location: /test.html');
?>