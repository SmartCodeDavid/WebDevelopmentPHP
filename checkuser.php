<?php
	$User = $_POST['user'];
	include("db_conn.php");
	//echo $User;
	$sql = "SELECT * FROM users WHERE Username='$User'";
	//echo $sql;
	$results = $mysqli->query($sql);
	//echo $results->num_rows;
	if($results->num_rows > 0){
		echo "true";
	}else{
		echo "false";
	}
	
	
?>