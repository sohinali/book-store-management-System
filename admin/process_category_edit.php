<?php
	session_start();

	if(! empty($_POST))
	{
		extract($_POST);
		$_SESSION['error']=array();
		
		if(empty($cat))
		{
			$_SESSION['error'][]="Please enter Category Name";
			header("location:category_edit.php?id=$id");
		}
		else
		{
			include("../includes/connection.php");

			$q="update category
			set cat_nm='$cat'
			where cat_id=$id";
	
			mysqli_query($mysqli,$q);
	
			header("location:category_view.php");
		}
	}
	else
	{
		header("location:category_view.php");
	}

?>