<?php

	session_start();

	require("includes/connection.php");

	if(!empty($_POST))
	{
		$_SESSION['error']=array();
		extract($_POST);

		if(empty($unm))
		{
			$_SESSION['error']['unm']="Please enter User Name";
		}
		else if(empty($unm))
		{
			$_SESSION['error']['unm']="Wrong User Name";
		}
		else if(empty($answer))
		{
			$_SESSION['error']['unm']="Please enter Security Answer";
		}

		if(empty($unm))
		{
			$_SESSION['error']['answer']="Please enter Security Answer";
		}

		if(empty($pwd) || empty($cpwd))
		{
			$_SESSION['error']['pwd']="Please enter New Password";
		}
		else if($pwd != $cpwd)
		{
			$_SESSION['error']['pwd']="Password isn't Match";
		}

		$q="select * from register where r_unm='$unm'";

		$res=mysqli_query($mysqli,$q);

		$row=mysqli_fetch_assoc($res);

		if(!empty($_SESSION['error']))
		{
			header("location:forget_password.php");
		}
		else
		{
			$id=$row['r_id'];

			$q="update register set r_pwd='$pwd' where r_id = '$id' AND r_answer = '$answer'";
	
			mysqli_query($mysqli,$q);
	
			header("location:login.php?forget");

		}
	}
	else
	{
		header("location:forget_password.php");
	}

?>