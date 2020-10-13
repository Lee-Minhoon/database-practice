<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "1234", "books");
		return $conn;
	}
?>