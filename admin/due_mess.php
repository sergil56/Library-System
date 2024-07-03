<?php
//Start of the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
  exit();
}
?>
<?php
if (isset($_GET['id'])) {
  require_once 'includes/conn.php';
  $id = $_GET['id'];

  $ID = htmlspecialchars(trim($id));
  $query = "SELECT * FROM tbl_issue WHERE id='$id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $email = $row['email'];
      $name = $row['name'];
      $due_date = $row['due_date'];
      $issue_date = $row['issue_date'];
      $book_id = $row['book_id'];
      $user_id = $row['user_id'];
    }
  }
}
?>

<?php
$id = $_REQUEST['id'];

$ID = htmlspecialchars(trim($id));
$query = "SELECT * FROM tbl_book WHERE id='$book_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result)) {
    $book_name = $row['book_name'];
    $author = $row['author'];
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Messages</title>
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
          <i class="fa fa-bell"></i>
          <label class="control-label">
            <h4><b>Notify Late Returned Books</b></h4>
          </label>
        </div>
        <form action="notif.php" method="POST" class="col-lg-5" enctype="multipart/form-data">
          <table class="table table-bordered bg-light" id="message">
            <tr>
              <td>
              <label class="control-label"><b> <i class="fa fa-info-circle"></i> Borrower Information:</b></label><br>
                <label class="control-label"><b>Receiver Email</b></label>
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
              </td>
            </tr>
            <tr>
              <td>
                <label class="control-label"><b>Receiver Name</b></label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
              </td>
            </tr>
            <tr>
              <td>
                <label class="control-label"><b> <i class="fa fa-info-circle"></i> Borrowed Book Information:</b></label><br>
                <label class="control-label"><b>Book Name</b></label>
                <input type="text" class="form-control" name="book_name" value="<?php echo $book_name; ?>" />
                <label class="control-label"><b>Author Name</b></label>
                <input type="text" class="form-control" name="author" value="<?php echo $author; ?>" />
                <label class="control-label"><b>Issue Date</b></label><input type="text" class="form-control" name="issue_date" value="<?php echo $issue_date; ?>" />
                <label class="control-label"><b>Due Date</b></label><input type="text" class="form-control" name="due_date" value="<?php echo $due_date; ?>" />
              </td>
            </tr>
          </table>
          <input type="submit" name="send" value="Send Message" style=" --bs-btn-font-size: .85rem;" class="btn btn-success"><a href="return.php?id=<?php echo $row['id']; ?>"></a>
        </form>
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