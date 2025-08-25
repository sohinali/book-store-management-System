<?php
include("includes/header.php");
include("../includes/connection.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transaction History</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Bank Balance</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Book Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sql = "SELECT oi.book_id, oi.item_no, oi.subtotal, bk.b_nm, od.o_id
                                    FROM `order_items` AS oi 
                                    JOIN `order` AS od ON oi.o_id = od.o_id 
                                    JOIN book AS bk ON oi.book_id = bk.b_id
                                    WHERE oi.status = 'delivered'";

                            $r_res = mysqli_query($mysqli, $sql);
                            
                            if (!$r_res) {
                                echo "<tr><td colspan='4'>Error: " . mysqli_error($mysqli) . "</td></tr>";
                            } else {
                                $count = 1;
                                $total_amount = 0;

                                while ($r_row = mysqli_fetch_assoc($r_res)) {
                                    $book_name = isset($r_row['b_nm']) ? htmlspecialchars($r_row['b_nm']) : 'N/A';
                                    $item_no = isset($r_row['item_no']) ? intval($r_row['item_no']) : 0;
                                    $subtotal = isset($r_row['subtotal']) ? floatval($r_row['subtotal']) : 0.00;

                                    echo "<tr class='odd gradeX'>
                                        <td>{$count}</td>
                                        <td>{$book_name}</td>
                                        <td>{$item_no}</td>
                                        <td>{$subtotal}</td>
                                    </tr>";

                                    $total_amount += $subtotal;
                                    $count++;
                                }

                                // Agar koi data na ho
                                if ($count === 1) {
                                    echo "<tr><td colspan='4' style='text-align:center;'>No transactions found.</td></tr>";
                                }
                            }
                            ?>

                            <!-- Show Total Row -->
                            <tr>
                                <td colspan="3" style="text-align: right; font-weight: bold;">Total Amount:</td>
                                <td style="font-weight: bold;"><?php echo number_format($total_amount, 2); ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<!-- jQuery and DataTables Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

<script>
    $(document).ready(function() {
        if ($('#dataTables-example').length) {
            $('#dataTables-example').DataTable({
                "responsive": true,
                "autoWidth": false
            });
        }
    });
</script>
