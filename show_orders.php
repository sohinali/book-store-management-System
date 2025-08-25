<?php
include("includes/header.php");
?>

<div id="content">
    <div class="post">
        <h2 class="title"><a href="#" style="color:black;">Orders</a></h2>
        <p class="meta"></p>
        <div class="entry">
            
            <table class="cart" cellspacing="0" border="0" width="100%">
                <tr align="center">
                    <th width="7%" style="color:white;">No</th>
                    <th width="30%" style="color:white;">Book Name</th>
                    <th width="15%" style="color:white;">Qty</th>
                    <th width="10%" style="color:white;">Price</th>
                    <th width="10%" style="color:white;">Status</th>
                    <th width="15%" style="color:white;">Action</th>
                </tr>

                <?php
                include("includes/connection.php");

                $o_id = $_SESSION['client']['id']; // Fetching client ID

                $query = "
                    SELECT 
                        oi.o_id, 
                        oi.book_id, 
                        b.b_nm,
                        oi.item_no, 
                        oi.subtotal, 
                        oi.status,
                        oi.cancelled
                    FROM 
                        order_items oi
                    INNER JOIN 
                        `order` os ON oi.o_id = os.o_id
                    INNER JOIN 
                        book b ON oi.book_id = b.b_id
                    WHERE 
                        os.o_rid = '$o_id' AND oi.cancelled != 'Yes'
                ";

                $result = mysqli_query($mysqli, $query);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        // ✅ Status Color Logic
                        $statusColor = "";
                        if ($row['status'] == "Pending") {
                            $statusColor = "color:#FF5733; font-weight:bold;";  // Red
                        } elseif ($row['status'] == "Processing") {
                            $statusColor = "color:#FFA500; font-weight:bold;";  // Orange
                        } elseif ($row['status'] == "Delivered") {
                            $statusColor = "color:#28A745; font-weight:bold;";  // Green
                        }

                        echo "<tr align='center'>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['b_nm'] . "</td>";
                        echo "<td>" . $row['item_no'] . "</td>";
                        echo "<td>" . $row['subtotal'] . "</td>";
                        echo "<td style='" . $statusColor . "'>" . $row['status'] . "</td>"; // Apply color

                        echo "<td>";
                        if ($row['status'] == 'Pending' || $row['status'] == 'Processing') {
                            echo "<form method='POST' action='cancel_order.php' id='cancelForm_".$row['o_id']."' style='display:inline-block;'>
                                    <input type='hidden' name='order_id' value='" . $row['o_id'] . "'>
                                    <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
                                    <button type='button' onclick='confirmCancel(".$row['o_id'].")' style='background-color:red; color:white; padding:5px 10px; border:none; cursor:pointer;'>Cancel</button>
                                  </form>";
                        } else {
                            echo "<span style='color:gray; font-weight:bold;'>Not cancellable</span>";
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' align='center'>No orders found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmCancel(orderId) {
        let confirmAction = confirm("Do you really want to cancel your order?");
        if (confirmAction) {
            document.getElementById('cancelForm_' + orderId).submit();
        }
    }
</script>

<?php
include("includes/footer.php");
?>
