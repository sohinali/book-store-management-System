<?php

	session_start();
	
	include("../includes/connection.php");

	$query="delete from book where b_id =".$_GET['id'];

	$result=mysqli_query($mysqli,$query);

	// $run=mysql_fetch_assoc($result);

	header("location:category_view.php");

?>