<?php $page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1); ?>
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
$session = $_SESSION['id'];
include 'includes/conn.php';
$result = mysqli_query($conn, "SELECT * FROM admins where id= '$session'");
while ($row = mysqli_fetch_array($result)) {
  $sessionuname = $row['username'];
  $sessionname = $row['name'];
  $sessionemail = $row['AdminEmail'];
}
?>
<?php
if (isset($_GET['user_id'])) {
  include 'includes/conn.php';
  $ID = $_GET['user_id'];

  $ID = htmlspecialchars(trim($ID));
  $query = "SELECT * FROM	users WHERE user_id='$ID'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $lib_id = $row['lib_id'];
      $email = $row['email'];
      $password = $row['password'];
      $fname = $row['fname'];
      $mdname = $row['mdname'];
      $lname = $row['lname'];
      $mobile = $row['mobile'];
      $year_level = $row['year_level'];
      $regdate = $row['regdate'];
    }
  }
} else {
  header('');
}
?>

<?php
include 'includes/conn.php';
$issue = mysqli_query($conn, "SELECT * FROM tbl_issue where status = 1");
$issue = mysqli_num_rows($issue);
?>
<?php
include 'includes/conn.php';
$return = mysqli_query($conn, "SELECT * FROM tbl_issue where status = 3");
$return = mysqli_num_rows($return);
?>
<?php
include 'includes/conn.php';
$books = mysqli_query($conn, "SELECT * FROM tbl_book");
$books = mysqli_num_rows($books);
?>
<?php
include 'includes/conn.php';
$issuedbook = mysqli_query($conn, "SELECT * FROM tbl_issue");
$issuedbook = mysqli_num_rows($issuedbook);
?>
<?php
include 'includes/conn.php';
$users = mysqli_query($conn, "SELECT * FROM users");
$users = mysqli_num_rows($users);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MNHS Library Portal</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
  <link rel="icon" href="assets/img/libhub-logo.png">
  <link rel="stylesheet" href="assets/css/style2.css" class="rel">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/maxcdnbootstrap.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php include "includes/sidebar.php" ?>
    <div class="main">
      <?php include "includes/header.php" ?>
      <main class="content px-3 py-2">
        <div class="card">
          <div class="card-body py-4" id="card">
            <h5 class="font-weight-semibold">
              <?php
              date_default_timezone_set("Asia/Manila");
              $h = date('G');

              if ($h >= 5 && $h <= 11) {
                echo "Good Morning";
              } else if ($h >= 12 && $h <= 17) {
                echo "Good Afternoon";
              } else {
                echo "Good Evening";
              }
              ?>, <?php echo $sessionname; ?>!!
            </h5>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="">
              <br>
              <div class="mdc-layout-grid__inner">
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                  <div class="mdc-card info-card info-card--success">
                    <div class="card-inner">
                      <h5 class="card-title">Total Books Issued</h5>
                      <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $issue; ?></h5>
                      <a href="books_borrowed.php"><span class="badge text-success me-2"> View Book Issued</span></a>
                      <div class="card-icon-wrapper">
                        <i class="fa-solid fa-computer"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                  <div class="mdc-card info-card info-card--danger">
                    <div class="card-inner">
                      <h5 class="card-title">Total Books Inventory</h5>
                      <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $books; ?></h5>
                      <a href="books.php"><span class="badge text-danger me-2"> View Book List</span></a>
                      <div class="card-icon-wrapper">
                        <i class="fa-solid fa-swatchbook"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                  <div class="mdc-card info-card info-card--primary">
                    <div class="card-inner">
                      <h5 class="card-title">Total Registered Users</h5>
                      <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $users; ?></h5>
                      <a href="manageusers.php"><span class="badge text-primary me-2"> View Registered Users</span></a>
                      <div class="card-icon-wrapper">
                        <i class="fa-solid fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                  <div class="mdc-card info-card info-card--info">
                    <div class="card-inner">
                      <h5 class="card-title">Total Books Returned</h5>
                      <h5 class="font-weight-light pb-2 mb-1 border-bottom"><?php echo $return; ?></h5>
                      <a href="books_borrowed.php"><span class="badge text-info me-2"> View List</span></a>
                      <div class="card-icon-wrapper">
                        <i class="fa-solid fa-reply-all"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="gap-20">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0" id="admin">
              <div class="card-body py-3" id="card">
                <div class="d-flex align-items-start">
                  <div class="flex-grow-1">
                    <div>
                      <h2 class="mb-3" style="text-transform: capitalize; font-family:'Times New Roman', Times, serif;">Search User</h2>
                    </div>
                    <form method="GET" name="form1" class="form-inline">
                      <div class="form-group col-md-5 mb-2">
                        <label>Search User Information :</label>
                        <input type="text" class="form-control" name="key" style="font-weight:bold; " placeholder="Search" required>
                        <br>
                        <select name="type" class="form-control">
                          <option value="1">Library ID</option>
                          <option value="2">First Name</option>
                          <option value="3">Middle Name</option>
                          <option value="4">Last Name</option>
                        </select>

                      </div>
                      <input type="submit" name="searchuser" value="Search" class="btn btn-success" id="ba" style=" --bs-btn-font-size: .95rem;"></input>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0" id="admin">
              <div class="card-body py-3" id="card">
                <div class="d-flex align-items-start">
                  <div class="flex-grow-1">
                    <div>
                      <h2 class="mb-3" style="text-transform: capitalize; font-family:'Times New Roman', Times, serif;">Search Book
                      </h2>
                    </div>
                    <form method="GET" name="form1" class="form-inline">
                      <div class="form-group col-md-5 mb-2">
                        <label>Search Book Information :</label>
                        <input type="text" class="form-control" name="key" style="font-weight:bold; " placeholder="Search" required>
                        <br>
                        <select name="type" class="form-control">
                          <option value="1">Book Title</option>
                          <option value="2">Subject</option>
                          <option value="3">Author</option>
                          <option value="4">Category</option>
                        </select>

                      </div>
                      <input type="submit" name="search" value="Search" class="btn btn-success" id="ba" style=" --bs-btn-font-size: .95rem;"></input>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 ">
            <?php
            if (isset($_GET['search'])) {
              require_once 'includes/conn.php';

              $type = $_GET['type'];
              $key = $_GET['key'];

              $s_type = htmlspecialchars(trim($type));
              $s_key = htmlspecialchars(trim($key));

              if ($s_type == 1) {
                $column = 'book_name';
              } else if ($s_type == 2) {
                $column = 'subject';
              } else if ($s_type == 3) {
                $column = 'author';
              } else if ($s_type == 4) {
                $column = 'category';
              }

              $query = "SELECT id,book_image,isbnno,book_name,category,publisher,author
							              FROM tbl_book WHERE $column LIKE '%$key%'";

              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="card">
                  <div class="card-body">
                    <div class="alert alert-success text-left">
                      <i class="fa fa-search"></i>
                      Search Results for "<strong><?php echo
                                                  $key; ?></strong>"
                    </div>
                    <table class="table table-bordered table-center table-hover">
                      <thead class="text-center">
                        <tr>
                          <th> ID </th>
                          <th>Image</th>
                          <th>Book Name</th>
                          <th>ISBN</th>
                          <th>Category</th>
                          <th>Subject</th>

                        </tr>
                      </thead>
                      <tbody>
                          <?php while ($row = mysqli_fetch_array($result)) {
                            $book_id = $row['id'];
                            $book_image = $row['book_image'];
                            $ISBN = $row['isbnno'];
                            $title = $row['book_name'];
                            $category = $row['category'];
                            $publisher = $row['publisher'];
                            $author = $row['author'];
                          ?>
                            <tr>
                              <td class="text-center"><?php echo $book_id; ?></td>
                              <td class="text-center"><img src="<?php echo "../uploads/" . $book_image; ?>" height="60" width="50" alt=""></td>
                              <td class="text-center"><a href="#" data-id='<?php echo $row['id']; ?>' class="userinfo"><?php echo $title; ?></a><br> <em><?php echo $author; ?> </em></td>
                              <td class="text-center"><?php echo $ISBN; ?></td>
                              <td class="text-center"><?php echo $category; ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              <?php
              } else {
              ?>
                <div class="alert alert-danger text-center">
                  No result for <strong><?php echo
                                        $key; ?></strong>
                </div>
            <?php
              }
            }
            ?>
          </div>
          <div class="col-12 ">
            <?php
            if (isset($_GET['searchuser'])) {
              require_once 'includes/conn.php';

              $type = $_GET['type'];
              $key = $_GET['key'];

              $s_type = htmlspecialchars(trim($type));
              $s_key = htmlspecialchars(trim($key));

              if ($s_type == 1) {
                $column = 'lib_id';
              } else if ($s_type == 2) {
                $column = 'fname';
              } else if ($s_type == 3) {
                $column = 'mdname';
              } else if ($s_type == 4) {
                $column = 'lname';
              }

              $query = "SELECT lib_id,fname,lname,mdname,mobile,photo,email,year_level,address,regdate
							              FROM users WHERE $column LIKE '%$key%'";

              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="card">
                  <div class="card-body">
                    <div class="alert alert-success text-left">
                      <i class="fa fa-search"></i>
                      Search Results for "<strong><?php echo
                                                  $key; ?></strong>"
                    </div>
                    <?php $results = mysqli_query($conn, "SELECT * FROM users"); ?>
                    <table class="table table-bordered table-center table-hover">
                      <thead class="text-center">
                        <tr>
                          <th>Library ID</th>
                          <th>Student Name</th>
                          <th>Email</th>
                          <th>Mobile Number</th>
                          <th>Year Level</th>
                          <th>Register Date</th>
                          <th colspan="2">Action</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <tr>
                            <td><?php echo $row['lib_id']; ?></td>
                            <td><?php echo $row['lname'] . ',' . $row['fname'] . ' ' . $row['mdname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['year_level']; ?></td>
                            <td><?php echo $row['regdate']; ?></td>
                            <td>
                              <div>
                                <form action="" method="POST">
                                  <a href="viewprofile.php?id=<?php echo $row['user_id']; ?>" id="action">
                                    <i class="fa fa-eye text-primary"></i></a>
                                  ||
                                  <a href="del_acc.php?user_id=<?php echo $row['user_id']; ?>" onclick="return confirm('Do you really want to Delete ?');" id="action">
                                    <i class="fas fa-trash text-danger"></i></a>
                                </form>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php
              } else {
              ?>
                <div class="alert alert-danger text-center">
                  No result for <strong><?php echo
                                        $key; ?></strong>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script type='text/javascript'>
    $(document).ready(function() {
      $('.userinfo').click(function() {
        var bookid = $(this).data('id');
        $.ajax({
          url: 'code.php',
          type: 'POST',
          data: {
            bookid: bookid
          },
          success: function(response) {
            $('.modal-body').html(response);
            $('#empModal').modal('show');
          }
        });
      });
    });
  </script>

  <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
</body>
<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
<!-- end -->

</html>