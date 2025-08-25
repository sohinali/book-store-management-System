<?php
include("includes/header.php");
?>

<div id="content">
    <div class="post">
        <h2 class="title"><a href="#" style="color:black;">Cart</a></h2>
        <p class="meta"></p>
        <div class="entry">
            <form action="addtocart.php" method="post">
                <table class="cart" cellspacing="0" border="0" width="100%">
                    <tr align="center">
                        <th width="7%" style="color:white;">No</th>
                        <th width="30%" style="color:white;">Name</th>
                        <th width="20%" style="color:white;">Image</th>
                        <th width="15%" style="color:white;">Qty</th>
                        <th width="10%" style="color:white;">Price</th>
                        <th width="10%" style="color:white;">Rate</th>
                        <th width="7%" style="color:white;">Remove</th>
                    </tr>

                    <?php
                    $count = 1;
                    $total = 0;
                    $cartNotEmpty = false;

                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        $cartNotEmpty = true;
                        foreach ($_SESSION['cart'] as $id => $val) {
                            $rate = $val['qty'] * $val['price'];
                            $total = $total + $rate;

                            echo '<tr>
                                    <td>' . $count . '</td>
                                    <td>' . $val['nm'] . '</td>
                                    <td><img src="' . $val['img'] . '" width="80" height="60"></td>
                                    <td><input type="number" min="1" value="' . $val['qty'] . '" style="width: 50px" name="' . $id . '"></td>
                                    <td>' . $val['price'] . '</td>
                                    <td>' . $rate . '</td>
                                    <td><a style="color: red;text-decoration:none;" href="addtocart.php?id=' . $id . '">X</a></td>
                                </tr>';

                            $count++;
                        }
                    }
                    ?>

                    <tr style="font-weight: bold;">
                        <td colspan="5">Total : </td>
                        <td colspan="2">Rs. <?php echo $total; ?></td>
                    </tr>
                </table>

                <div align="center" style="margin-top: 20px">
                    <input type="submit" value="Re-calculate" class="btn_refresh" style="color:white; background-color: black;">

                    <?php
                    if (!$cartNotEmpty) {
                      
                        echo '<a href="#" onclick="alert(\'Your cart is empty! Add items before proceeding.\');" style="margin-left: 10px; font-family: open sans;">Confirm & Submit Order</a>';
                    } elseif (!isset($_SESSION['client'])) {
                      
                        echo '<a href="#" onclick="alert(\'Please login to place an order!\');" style="margin-left: 10px; font-family: open sans;">Confirm & Submit Order</a>';
                    } else {
                   
                        echo '<a href="order.php?total=' . $total . '" name="button" style="margin-left: 10px; font-family: open sans;">Confirm & Submit Order</a>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>
