<?php
session_start();
include("includes/connection.php");

$items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (!empty($_POST)) {
    extract($_POST);
    extract($_SESSION);

    $_SESSION['error'] = array();

    if (empty($fnm)) {
        $_SESSION['error'][] = "Enter Full Name";
    }
    if (empty($add)) {
        $_SESSION['error'][] = "Enter Full Address";
    }
    if (empty($pc)) {
        $_SESSION['error'][] = "Enter City Pincode";
    }
    if (empty($city)) {
        $_SESSION['error'][] = "Enter City";
    }
    if (empty($state)) {
        $_SESSION['error'][] = "Enter State";
    }
    if (empty($mno)) {
        $_SESSION['error'][] = "Enter Mobile Number";
    } else if (!is_numeric($mno)) {
        $_SESSION['error'][] = "Enter Mobile Number in Numbers";
    }

    if (!empty($_SESSION['error'])) {
        header("location:order.php");
        exit();
    } else {
        $rid = $_SESSION['client']['id'];

        $q = "INSERT INTO `bms`.`order` (
                    `o_id`, `o_name`, `o_address`, `o_pincode`, `o_city`, `o_state`, `o_mobile`, `o_rid`
                ) VALUES (
                    NULL, '$fnm', '$add', '$pc', '$city', '$state', '$mno', '$rid'
                )";

        $res = mysqli_query($mysqli, $q);
        $last_order_id = mysqli_insert_id($mysqli);

        $countorderedbooks = count($items);
        for ($i = 0; $i < $countorderedbooks; $i++) {
            $qty = $items[$i]['qty'];
            $subtotal = $items[$i]['price'];
            $bcid = $items[$i]['bcid'];

            $query = "INSERT INTO `order_items`(`o_items`, `book_id`, `item_no`, `subtotal`, `o_id`) VALUES 
                     ('', $bcid, $qty, $subtotal, $last_order_id)";
            mysqli_query($mysqli, $query);
        }

        // ✅ **Empty Cart After Successful Order**
        unset($_SESSION['cart']);

        // ✅ **Redirect with Alert & Query Parameter**
        echo "<script>
                window.location.href = 'order.php?order';
              </script>";
        exit();
    }
} else {
    header("location:order.php");
    exit();
}
?>
