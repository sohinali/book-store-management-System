<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
    $_SESSION['error'] = array();
    $_SESSION['form_data'] = $_POST; // Store form data to retain values

    // Full Name Validation (Only Alphabets)
    if (empty($fnm)) {
        $_SESSION['error']['fnm'] = "Please enter Full Name";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $fnm)) {
        $_SESSION['error']['fnm'] = "Full Name should contain only alphabets and spaces";
    }

    // Username Validation (Must Contain Alphabets & Numbers)
    if (empty($unm)) {
        $_SESSION['error']['unm'] = "Please enter User Name";
    } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/", $unm)) {
        $_SESSION['error']['unm'] = "Username must contain both alphabets and numbers (no special characters)";
    }

   // Password Validation (Must be 8+ chars, include letters, numbers, and special characters)
if (empty($pwd)) {
    $_SESSION['error']['pwd'] = "Please enter Password";
} elseif (strlen($pwd) < 8) {
    $_SESSION['error']['pwd'] = "Password must be at least 8 characters long";
} elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/", $pwd)) {
    $_SESSION['error']['pwd'] = "Password must contain at least one letter, one number, and one special character (@$!%*?&)";
}

if (empty($cpwd)) {
    $_SESSION['error']['cpwd'] = "Please confirm your Password";
} elseif ($pwd !== $cpwd) {
    $_SESSION['error']['cpwd'] = "Passwords don't match";
}


    // Email Validation
    if (empty($email)) {
        $_SESSION['error']['email'] = "Please enter E-Mail Address";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']['email'] = "Please enter a valid E-Mail Address";
    }

    // Contact Number Validation (Only 10 Digits)
    if (empty($cno)) {
        $_SESSION['error']['cno'] = "Please enter Contact Number";
    } elseif (!preg_match("/^[0-9]{10}$/", $cno)) {
        $_SESSION['error']['cno'] = "Contact Number must be exactly 10 digits";
    }

    // Security Answer Validation
    if (empty($answer)) {
        $_SESSION['error']['answer'] = "Please enter Security Answer";
    }

    if (!empty($_SESSION['error'])) {
        header("location: register.php");
        exit();
    }

    // Normal SQL Query (No Change)
    include("includes/connection.php");
    $t = time();
    $q = "INSERT INTO register(r_fnm, r_unm, r_pwd, r_cno, r_email, r_question, r_answer, r_time) 
          VALUES ('$fnm','$unm','$pwd','$cno','$email','$question','$answer','$t')";

    mysqli_query($mysqli, $q);
    unset($_SESSION['form_data']); // Clear form data after successful registration
    header("location: register.php?register");
    exit();
}
?>
