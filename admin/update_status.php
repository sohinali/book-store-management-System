<?php
include("../includes/connection.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Error: Invalid request method!");
}

if (!isset($_POST['order_id']) || !isset($_POST['book_id']) || !isset($_POST['status'])) {
    die("Error: Missing parameters!");
}

$orderId = mysqli_real_escape_string($mysqli, $_POST['order_id']);
$bookId = mysqli_real_escape_string($mysqli, $_POST['book_id']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);

$query = "UPDATE `order_items` SET status='$status' WHERE o_id='$orderId' AND book_id='$bookId'";

if (mysqli_query($mysqli, $query)) {
    header("Location: orderd.php"); // ✅ Redirect to orderd.php on success
    exit();
} else {
    echo "Error: " . mysqli_error($mysqli);
}
?>
