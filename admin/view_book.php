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
include 'includes/conn.php';
$ID = $_GET['id'];

if (isset($_POST["update"])) {

  $book_name = $_POST['book_name'];
  $category_name = $_POST['category'];
  $isbn = $_POST['isbnno'];
  $author_name = $_POST['author'];
  $publisher_name = $_POST['publisher'];
  $quantity = $_POST['quantity'];
  $year = $_POST['year'];
  $edition = $_POST['edition'];
  $volume = $_POST['volume'];
  $subject = $_POST['subject'];
  $short_desc = $_POST['short_desc'];


  $result = mysqli_query($conn, "update tbl_book set book_name='$book_name', category='$category_name',isbnno='$isbn',author='$author_name',publisher='$publisher_name',quantity='$quantity',year='$year',edition='$edition',volume='$volume',subject='$subject',short_desc='$short_desc' where id='$ID'");

  if ($result) {
    header("Location:books.php?success=Successfully Updated Book Information");
  } else {
    header("Location:  view_book.php?error=FAILED");
    mysqli_error($conn);
  }
}

?>

<?php
if (isset($_GET['id'])) {
  require_once 'includes/conn.php';
  $ID = $_GET['id'];

  $ID = htmlspecialchars(trim($ID));
  $query = "SELECT * FROM	tbl_book WHERE id='$ID'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $book_name = $row['book_name'];
      $category_name = $row['category'];
      $isbn = $row['isbnno'];
      $author_name = $row['author'];
      $publisher_name = $row['publisher'];
      $quantity = $row['quantity'];
      $year = $row['year'];
      $edition = $row['edition'];
      $volume = $row['volume'];
      $subject = $row['subject'];
      $short_desc = $row['short_desc'];
      $created_at = $row['created_at'];
      $book_image = $row['book_image'];
    }
  }
} else {
  header('manageusers.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Profile</title>
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
              <li class="breadcrumb-item"><a href="books.php">Listed Books</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Book Details</li>
            </ul>
          </div>
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
          <div class="row">
            <div class="col-lg-5">
              <div class="row">
                <div class="card flex-fill border-0" id="admin">
                  <br>
                  <h6 class="user-profile">Book Photo</h6>
                  <div class="text-right pb-4">
                    <div class="col-12 text-center">

                      <img src="<?php echo "../uploads/" . $book_image; ?>" class="rounded mx-auto d-block" id="img-big" height="415" width="380" alt="No Image">
                      <span class="badge rounded-pill text-primary">Last updated on: <?php echo $created_at; ?> </span>
                      <br>
                      <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="photo" class="modal-mt" id="card">
                        <input type="submit" id="ba" class="btn btn-primary" style=" --bs-btn-font-size: .90rem;" value="Upload Image" name="record">
                      </form>
                    </div>
                  </div>

                  <?php
                  if (isset($_POST["record"])) {

                    $book_image = $_FILES['book_image'];
                    $img_loc = $_FILES['book_image']['tmp_name'];
                    $book_image = $_FILES['book_image']['name'];

                    $img_des = "../uploads/" . $book_image;
                    move_uploaded_file($img_loc, '../uploads/' . $book_image);

                    $insert_book = mysqli_query($conn, "insert into tbl_book set book_image='$img_des'  where id='$ID");

                  ?>
                    
                  <?php
                  }
                  ?>

                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card flex-fill border-0" id="admin">
                <br>
                <h6 class="user-profile">Edit Book Details</h6>
                <div class="card-body py-4">
                  <div class="">
                    <div class="details">
                      <form method="post">
                        <div class="row">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group field-title required has-error">
                                <center><label class="control-label"><b>Book Title</b></label></center>
                                <input type="text" class="form-control custom" name="book_name" value="<?php echo $book_name ?>" required />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group field-author required has-error">
                                <label class="control-label"><b>Author</b></label>
                                <br><input type="text" class="form-control custom" name="author" value="<?php echo $author_name ?>" required />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group field-copyright required has-error">
                                <label class="control-label"><b>Copyright Year</b></label>
                                <br><input type="text" class="form-control custom" name="year" value="<?php echo $year ?>" required />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group field-publisher required has-error">
                                <label class="control-label"><b>Publisher</b></label>
                                <br><input type="text" class="form-control custom" name="publisher" value="<?php echo $publisher_name ?>" required />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group field-isbn required has-error">
                                <label class="control-label"><b>ISBN</b></label>
                                <br><input type="text" class="form-control custom" name="isbnno" value="<?php echo $isbn ?>" required />
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group field-edition required has-error">
                                <label class="control-label"><b>Edition</b></label>
                                <br><input type="text" class="form-control custom" name="edition" value="<?php echo $edition ?>" required />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group field-volume required has-error">
                                <label class="control-label"><b>Volume</b></label>
                                <select class="form-control" name="volume">
                                  <option><?php echo $volume ?></option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group field-category required has-error">
                                <label class="control-label"><b>Category</b></label>
                                <select class="form-control" name="category">
                                  <option><?php echo $category_name ?></option>
                                  <?php
                                  $sql = "SELECT * FROM category";
                                  $query = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($query)) { ?>
                                    <option value="<?php echo $row['cat_name'] ?>" ?><?php echo $row['cat_name']; ?></option>
                                  <?php  } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group field-subject required has-error">
                                <label class="control-label"><b>Subject</b></label>
                                <select class="form-control" name="subject">
                                  <option><?php echo $subject ?></option>
                                  <?php
                                  $sql = "SELECT * FROM subject";
                                  $query = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($query)) { ?>
                                    <option value="<?php echo $row['sub_name'] ?>" <?php echo isset($_GET['sub_name']) && $_GET['sub_name'] == $row['sub_name'] ? "selected" : "" ?>><?php echo $row['sub_name']; ?></option>
                                  <?php  } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group field-quantity required has-error">
                                <label class="control-label"><b>Add Quantity</b></label>
                                <input type="number" class="form-control custom" name="quantity" value="<?php echo $quantity ?>" />
                              </div>
                            </div>
                            <div class="form-group field-description required has-error">
                              <label class="control-label"><b>Short Description</b></label>
                              <input type="text" class="form-control custom" name="short_desc" value="<?php echo $short_desc ?>" />
                            </div>
                          </div>
                        </div>
                        <br>
                        <div class="col-12">
                          <input type="submit" id="ba" class="btn btn-primary" style=" --bs-btn-font-size: .90rem;" value="Update" name="update">
                          <a href="del_acc.php?user_id=<?php echo $ID; ?>" onclick="return confirm('Do you really want to Delete ?');"><input type="button" class="btn btn-danger" id="br" value="Delete" style=" --bs-btn-font-size: .90rem;">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
<!-- end -->

</html>