<?php
	session_start();
	if(!isset($_SESSION['id']))
	{
		echo "<script>location.href = './login.html'</script>";
	}
	echo '현재로그인중 : ';
	echo $_SESSION['name'];
	echo '(';
	echo $_SESSION['id'];
	echo ')<br><br>';
?>