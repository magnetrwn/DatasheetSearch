<?php
	function open_mysql_conn(){
		$servername = "127.0.0.1";
		$username = "root";
		$password = "polli_mysql";
		$dbname = "ds";

		$conn = mysqli_connect($servername, $username, $password, $dbname);
	
		if (!$conn)
			die();
		return $conn;
	}
	
	function close_mysql_conn($conn){
		mysqli_close($conn);
	}
?>
