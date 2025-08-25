<?php
include("includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the order_id and book_id from the POST request
    $orderId = $_POST['order_id'];
    $bookId = $_POST['book_id'];

    // Check if the order status is 'Pending' or 'Processing'
    $query = "SELECT status FROM `order_items` WHERE o_id = '$orderId' AND book_id = '$bookId'";
    $result = mysqli_query($mysqli, $query); 

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $orderStatus = $row['status'];

        // Allow cancellation only if the order status is 'Pending' or 'Processing'
        if ($orderStatus == 'Pending' || $orderStatus == 'Processing') {
            // Update the cancellation status of the book
            $cancelQuery = "UPDATE `order_items` SET cancelled = 'Yes' WHERE o_id = '$orderId' AND book_id = '$bookId'";

            if (mysqli_query($mysqli, $cancelQuery)) {
                echo "<script>
                        alert('Order cancelled successfully!');
                        window.location.href = 'show_orders.php';
                      </script>";
                exit();
            } else {
                echo "<script>
                        alert('Error: " . mysqli_error($mysqli) . "');
                        window.location.href = 'show_orders.php';
                      </script>";
                exit();
            }
        } else {
            echo "<script>
                    alert('Cancellation is not allowed as the order is already $orderStatus');
                    window.location.href = 'show_orders.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Order not found!');
                window.location.href = 'show_orders.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Invalid request!');
            window.location.href = 'show_orders.php';
          </script>";
    exit();
}
?>
