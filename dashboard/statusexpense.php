<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
include('../includes/connection.php');
if (isset($_POST['statusrequest'])) {
    $id = $_SESSION['id'];
    $statusrequest = $_POST['statusrequest'];
    $sql = "select * from expense WHERE payment_status = '$statusrequest' AND school_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

?>
    <table class="table">
        <?php
        if ($count) {
        ?>
            <thead>
                <tr>
                    <th scope="col">Sr.no</th>
                    <th scope="col">Expense Type</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Description</th>
                    <th scope="col">Payment Mode</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">Action</th>
                </tr>
            <?php
        } else {
            echo "No Records found";
        } ?>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $row['expense_type']; ?></td>
                        <td><?php echo $row['purpose']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['payment_method']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                        <td><?php echo $row['expense_date']; ?></td>
                        <td>
                            <?php if ($row['file']) { ?>
                                <a href="download.php?file=<?php echo urlencode($row['file']); ?>" target="_new" title="Download File" class="btn btn-info"><i class="bi bi-download"></i></a>
                            <?php } ?>

                            <a href="expense-delete.php.php?expenseid=<?php echo $row["expense_id"]; ?>" onclick="return checkdelete()" title="Delet" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
    </table>
<?php
} 
?>

