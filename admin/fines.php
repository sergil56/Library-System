<?php
session_start();
include('includes/conn.php');
$ids = $_SESSION['id'];
if (empty($ids)) {
    header("Location: http://localhost/MNHS_LibPortal/");
}
?>
<?php
include('includes/conn.php');
$ids = $_SESSION['id'];
if (empty($ids)) {
    header("Location: http://localhost/MNHS_LibPortal/");
} ?>

<?php
require 'includes/conn.php';

if (isset($_POST['del'])) {
    $id = trim($_POST['del-btn']);
    $msg = "PAID";
    $sql = "UPDATE tbl_issue set `fine` = '$msg' where id = '$id'";
    $query = mysqli_query($conn, $sql);
    $error = false;
    if ($query) {
        $error = true;
    }
}
?>

<?php
include 'includes/conn.php';


if (isset($_POST['check'])) {
    $id = $_POST['id'];

    $sql = "SELECT due_date from tbl_issue where id = '$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    $now = date_create(date('Y-m-d'));
    "<br>";
    $prev =  date_create(date("Y-m-d", strtotime($row['due_date'])));
    "<br>";
    $diff = date_diff($prev, $now);
    "<br>";
    $diff = str_replace('+', '', $diff->format('%R%a'));
    if ($diff > 0) {
        // echo "greater";
        $fine = 1 * $diff;

        $add = "UPDATE `tbl_issue` SET `fine`= '$fine' WHERE id = '$id'";
        $query = mysqli_query($conn, $add);
    } else if ($now < $prev) {
        // echo "lesser";
        $add = "UPDATE `tbl_issue` SET `fine`= '0' WHERE id = '$id'";
        $query = mysqli_query($conn, $add);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fines</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
    <link rel="icon" href="assets/img/libhub-logo.png">
    <link rel="stylesheet" href="assets/css/style2.css" class="rel">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php include "includes/sidebar.php" ?>
        <div class="main">
            <?php include "includes/header.php" ?>
            <main class="content px-3 py-2">
                <div class="mb-3">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="landingpage.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Late Return Penalty</li>
                    </ul>
                </div>
                <div class="card ">
                    <div class="card-header">
                        <i class="fa fa-info-circle"></i>
                        Late Return Penalty
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <colgroup>
                                <col width="5%">
                                <col width="25%">
                                <col width="20%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Borrower</th>
                                    <th>Book</th>
                                    <th>Borrowed</th>
                                    <th>Returning</th>
                                    <th>Penalty</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "includes/conn.php";
                                $result = mysqli_query($conn, "select tbl_issue.status, tbl_issue.book_id,tbl_issue.email,tbl_issue.issue_date,tbl_book.book_name,tbl_book.author,  tbl_issue.id,tbl_issue.fine,tbl_issue.user_id, tbl_issue.name, tbl_book.isbnno,tbl_issue.due_date,tbl_book.quantity  from tbl_issue inner join tbl_book on tbl_issue.book_id=tbl_book.id where tbl_issue.status");
                                $sn = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <?php if ($row['due_date'] == date('Ymd') > date("Ymd", strtotime($row['due_date']))) : ?>
                                            <td class="text-center"><?php echo $sn++; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td>
                                                <b>Title: </b><?php echo $row['book_name']; ?><br>
                                                <b>Book Status: </b><?php echo $row['status'] == 3 ? '<div class="badge badge-success">Returned</div>' : '';
                                                                    echo $row['status'] == 1 ? '<div class="badge badge-success">Issued</div>' : '';
                                                                    echo ($row['status'] == 1) && (date('Ymd') > date("Ymd", strtotime($row['due_date']))) ? '<div class="badge badge-danger">Overdue</div>' : '';
                                                                    ?>
                                                <?php if ($row['status'] == 1) : ?>
                                                    <br>
                                                    <b>Date Received : </b> <?php echo date("M d,Y", strtotime($row['issue_date'])); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date("M d,Y", strtotime($row['issue_date'])); ?></td>
                                            <td><?php echo date("M d,Y", strtotime($row['due_date'])); ?></td>
                                            <?php
                                            if (!empty($row['fine']) && $row['fine'] == "PAID") { ?>
                                                <td class="text-center" style="font-size: smaller;">
                                                    <?php echo $row['status'] ? ' <span class="badge badge-pill badge-primary"><i class="fa-solid fa-money-bill-wave"></i> PAID</span>' : ''; ?>
                                                </td>
                                            <?php
                                            } else { ?>
                                                <td class="text-center">₱<?php echo $row['fine']; ?>
                                                </td>
                                            <?php
                                            } ?>
                                            <td>
                                                <?php if ($row['status'] == 3) : ?>
                                                    <form action="fines.php" method="post">
                                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="del-btn">
                                                        <button type="submit" id="br" class="btn btn-danger" style=" --bs-btn-font-size: .75rem;" name="del"><b>Pay Fine</b></button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 1) : ?>
                                                    <form action="fines.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" id="ba" class="btn btn-success" style="--bs-btn-font-size: .75rem;" name="check"><b>CHECK</b></button>
                                                    </form>
                                                    <a href="fine_mess.php?id=<?php echo $row['id']; ?>"><button type="submit" id="ba"  name="check" class="btn btn-warning" style=" --bs-btn-font-size: .75rem;"><b>Notify User</b></button></a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php $sn++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
<!-- end -->

</html>