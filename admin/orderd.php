<?php
include("includes/header.php");
include("../includes/connection.php");
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Orders</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Book List</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Book Name</th>
                                    <th>Order ID</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Address</th>
                                    <th>Pincode</th>
                                    <th>Register Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sql = "SELECT oi.book_id, oi.item_no, oi.subtotal, bk.b_nm, od.o_name, od.o_address, 
                                           od.o_city, od.o_state, od.o_pincode, oi.o_id, oi.status 
                                    FROM `order_items` AS oi 
                                    JOIN `order` AS od ON oi.o_id = od.o_id 
                                    JOIN book AS bk ON oi.book_id = bk.b_id";

                            $r_res = mysqli_query($mysqli, $sql);
                            $count = 1;

                            while ($r_row = mysqli_fetch_assoc($r_res)) {
                                echo '<tr class="odd gradeX">
                                    <td>' . $count . '</td>
                                    <td>' . $r_row['o_name'] . '</td>
                                    <td>' . $r_row['b_nm'] . '</td>
                                    <td>' . $r_row['o_id'] . '</td>
                                    <td>' . $r_row['item_no'] . '</td>
                                    <td>' . $r_row['subtotal'] . '</td>
                                    <td>' . $r_row['o_city'] . '</td>
                                    <td>' . $r_row['o_state'] . '</td>
                                    <td>' . $r_row['o_address'] . '</td>
                                    <td>' . $r_row['o_pincode'] . '</td>
                                    <td>' . @date("d-M-y", strtotime($r_row['o_id'])) . '</td>
                                    <td>
                                        <form action="update_status.php" method="POST">
                                            <input type="hidden" name="order_id" value="' . $r_row['o_id'] . '">
                                            <input type="hidden" name="book_id" value="' . $r_row['book_id'] . '">
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="Pending" ' . ($r_row['status'] == 'Pending' ? 'selected' : '') . '>Pending</option>
                                                <option value="Processing" ' . ($r_row['status'] == 'Processing' ? 'selected' : '') . '>Processing</option>
                                                <option value="Delivered" ' . ($r_row['status'] == 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>';
                                $count++;
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
include("includes/footer.php");
?>
