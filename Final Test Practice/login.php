<?php
	session_start();
	include "./include/connectDB.php";
	$conn = db_connect();
	$id = $_POST['id'];
	$pw = $_POST['pw'];

	$query = "SELECT * FROM user WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if($id == $row['id'] && $pw == $row['pw']){
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['userNum'] = $row['number'];
		echo "<script>location.href = './index.php'</script>";
	}else if($id == $row['id'] && $pw != $row['pw']){
		echo "<script>if(!alert('비번 틀림')) document.location = './login.html'</script>";
	}else{
		echo "<script>if(!alert('아이디 틀림')) document.location = './login.html'</script>";
	}
	mysqli_close($conn);
?>