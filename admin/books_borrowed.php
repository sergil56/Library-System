<?php
//Start of the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Issued Books</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
  <link rel="icon" href="assets/img/libhub-logo.png">
  <link rel="stylesheet" href="assets/css/style2.css" class="rel">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
</head>

<body>
  <div class="wrapper">
    <?php include "includes/sidebar.php" ?>
    <div class="main">
      <?php include "includes/header.php" ?>
      <main class="content px-3 py-2">
        <div class="container-fluid">
          <div class="mb-3">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="landingpage.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Issued Books</li>
            </ul>
          </div>
          <!-- Table Element -->
          <div class="card border" id="admin">
            <div class="">
              <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert"><?php echo $_GET['success']; ?></div>
              <?php } ?>
            </div>
            <div class="">
              <?php if (isset($_GET['delete'])) { ?>
                <div class="alert alert-danger" role="alert"><?php echo $_GET['delete']; ?></div>
              <?php } ?>
            </div>
            <div class="card-header">
              <div class="col-md-12 ">
                <td style="font-size: large;">
                  <a href="export_excel.php"><button type="submit" name="send" onclick="return confirm('Export Book Infromation to Excel ?');" class="btn btn-success float-end" style=" --bs-btn-font-size: .75rem;margin-right:10px;"><b>Export Issue Informations To Excel</b> </button></a>
                </td>
              </div>
              <i class="fa fa-info-circle"></i>
              Issued Books
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTables-example">
                  <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="20%">
                    <col width="20%">
                    <col width="5%">
                    <col width="5%">
                    <col width="30%">
                    <col width="10%">
                    <col width="10%">
                  </colgroup>
                  <thead>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Book Title</th>
                    <th>ISBN</th>
                    <th>Issued</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Notify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "includes/conn.php";
                    $select_query = mysqli_query($conn, "select tbl_issue.status, tbl_issue.book_id,tbl_issue.email,tbl_issue.issue_date,tbl_book.book_name,tbl_book.author,  tbl_issue.id,tbl_issue.user_id, tbl_issue.name, tbl_book.isbnno,tbl_issue.due_date,tbl_book.quantity from tbl_issue inner join tbl_book on tbl_book.id=tbl_issue.book_id");
                    $sn = 1;
                    while ($row = mysqli_fetch_array($select_query)) {
                    ?>
                      <tr>
                        <td><?php echo $sn; ?></td>
                        <td><?php echo $row['name']; ?><br> <em style="font-size:smaller;"><?php echo $row['email']; ?> </em></td>
                        <td>
                          <?php echo $row['book_name']; ?><br>
                          <em style="font-size:smaller;"><?php echo $row['author']; ?> </em><br>
                        </td>
                        <td><?php echo $row['isbnno']; ?></td>
                        <td style="font-size: small;"><span class="badge badge-pill badge-primary"><?php echo $row['issue_date']; ?></td>
                        <td style="font-size: small;"><span class="badge badge-pill badge-danger"><?php echo $row['due_date']; ?>
                        </td>
                        <?php
                        if (!empty($row['status']) && $row['status'] == 1) { ?>
                          <td class="text-center" style="font-size: smaller;">
                            <?php echo $row['status'] == 1 ? '<div class="badge badge-success">Book Issued</div>' : ''; ?>
                            <br>
                            <?php echo ($row['status'] == 1) && (date('Ymd') > date("Ymd", strtotime($row['due_date']))) ? '<div class="badge badge-danger">Overdue</div>' : '';
                            ?>
                          </td>
                        <?php
                        } else if ($row['status'] == 2) { ?>
                          <td class="text-center"><span class="badge badge-pill badge-danger"><i class="fa-solid fa-ban"></i> Rejected</span>
                          </td>
                        <?php
                        }
                        if ($row['status'] == 3) { ?>
                          <td class="text-center"><span class="badge badge-pill badge-primary"><i class="fa-solid fa-rotate-left"></i> Returned</span>
                          <?php echo ($row['status'] == 3) && (date('Ymd') > date("Ymd", strtotime($row['due_date']))) ? '<div class="badge badge-danger">Overdue</div>' : '';
                            ?>
                          </td>
                        <?php } ?>

                        <?php
                        if (!empty($row['status']) && $row['status'] == 1) { ?>
                          <td class="text-center"><a href="return.php?id=<?php echo $row['id']; ?>"><button type="button" id="ba" class="btn btn-success" style=" --bs-btn-font-size: .75rem;"> Return</button></a></td>
                        <?php } else if ($row['status'] == 0) { ?>
                          <center>
                            <td class="text-center">
                              <a href="acc_mess.php?id=<?php echo $row['id']; ?>"><button type="submit" name="send" id="ba" class="btn btn-success" style=" --bs-btn-font-size: .75rem;"><b>Accept</b> </button></a>
                              <a href="rej_mess.php?id=<?php echo $row['id']; ?>"><button type="button" id="br" class="btn btn-danger" style=" --bs-btn-font-size: .75rem;"><b>Reject</b></button></a>
                            </td>
                          </center>
                        <?php } ?>
                        <?php
                        if (!empty($row['status']) && $row['status'] == 1) { ?>
                          <td class="text-center"><a href="warn_mess.php?id=<?php echo $row['id']; ?>"><button type="button" id="br" class="btn btn-warning" style=" --bs-btn-font-size: .75rem;"> Notify!</button></a></td>
                        <?php } ?>

                      <?php $sn++;
                    } ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>

<!-- end -->

</html>