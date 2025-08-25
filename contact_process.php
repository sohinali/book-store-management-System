<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		extract($_POST);
		$_SESSION['error'] = array();
		$_SESSION['old'] = $_POST;  

		// Full Name Validation (Only alphabets & spaces, no numbers)
		if(empty($fnm))
		{
			$_SESSION['error']['fnm'] = "Please enter Full Name";
		}
		else if (!preg_match("/^[a-zA-Z ]+$/", $fnm)) 
		{
			$_SESSION['error']['fnm'] = "Full Name must contain only letters.";
		}

		// ✅ Mobile Number Validation (Must be exactly 10 digits & only numbers)
		if(empty($mno))
		{
			$_SESSION['error']['mno'] = "Please enter Mobile Number";
		}
		else if (!preg_match("/^[0-9]{10}$/", $mno)) 
		{
			$_SESSION['error']['mno'] = "Mobile Number must be exactly 10 digits (no alphabets).";
		}

		// ✅ Email Validation (Valid email format)
		if(empty($email))
		{
			$_SESSION['error']['email'] = "Please enter E-Mail ID";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$_SESSION['error']['email'] = "Please enter a valid E-Mail ID.";
		}

		
		if(empty($msg))
		{
			$_SESSION['error']['msg'] = "Please enter your message.";
		}


		if(!empty($_SESSION['error']))
		{
			header("Location: contact.php");
			exit;
		}

	
		include("includes/connection.php");

		$t = time();

		$q = "INSERT INTO contact (c_fnm, c_mno, c_email, c_msg, c_time) VALUES ('$fnm', '$mno', '$email', '$msg', '$t')";

		mysqli_query($mysqli, $q);

		// ✅ Set success flag
		$_SESSION['success'] = true;

		// ✅ Clear form values
		unset($_SESSION['old']);
		unset($_SESSION['error']);

		// ✅ Redirect to contact.php to show success
		header("Location: contact.php");
		exit;
	}
	else
	{
		header("Location: contact.php");
		exit;
	}
?>
