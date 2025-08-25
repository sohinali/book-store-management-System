<?php

	session_start();
	
	include("../includes/connection.php");

	$query="delete from contact where c_id =".$_GET['id'];

	$result=mysqli_query($mysqli,$query);
	print_r($result);

	// $run=mysqli_fetch_assoc($result);

	header("location:contact_view.php");

?>