<?php

	session_start();
	
	include("../includes/connection.php");

	$query="delete from register where r_id =".$_GET['id'];

	$result=mysqli_query($mysqli,$query);

	//$run=mysqli_fetch_assoc($result);

	header("location:users_view.php");

?>