<?php
	session_start();
	$var = session_destroy();
	if($var){
		echo "<script>location.href = './login.html'</script>";
	}
?>