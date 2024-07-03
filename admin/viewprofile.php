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
$ID = $_GET['user_id'];

if (isset($_POST["update"])) {

  $lib_id = $_POST['lib_id'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $mdname = $_POST['mdname'];
  $lname = $_POST['lname'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $year_level = $_POST['year_level'];


  $sql = "UPDATE `users` SET `lib_id`='$lib_id',`fname`='$fname',`lname`='$lname',`mdname`='$mdname',`address`='$address',`gender`='$gender',`mobile`='$mobile',`year_level`='$year_level',`email`='$email',`password`='$password'
  WHERE user_id = $ID";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location:manageusers.php?success=Successfully Updated User Information");
  } else {
    header("Location:  manageusers.php?error=FAILED");
    mysqli_error($conn);
  }
}

?>
<?php
if (isset($_POST["submit"])) {

  $photo = $_FILES['photo'];
  $img_loc = $_FILES['photo']['tmp_name'];
  $photo = $_FILES['photo']['name'];
  $img_des = "../profile/" . $photo;
  move_uploaded_file($img_loc, '../profile/' . $photo);

  $query = "UPDATE 'users' SET 'photo' ='$img_des' where id = $ID";
  $result = mysqli_query($conn, $query)

?>
  <script type="text/javascript">
    window.location = "profile.php";
  </script>
<?php
}
?>
<?php
if (isset($_GET['user_id'])) {
  require_once 'includes/conn.php';
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
      $address = $row['address'];
      $year_level = $row['year_level'];
      $gender = $row['gender'];
      $regdate = $row['regdate'];
      $upd_date = $row['up_date'];
      $photo = $row['photo'];
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
        <div class="mb-3">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="landingpage.php">Home</a></li>
            <li class="breadcrumb-item"><a href="manageusers.php">Registered Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ul>
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="row">
                <div class="card flex-fill border-0" id="admin">
                  <div class="card-body">
                    <h6 class="user-profile">User Photo</h6>
                  </div>
                  <div class="text-right pb-4">
                    <div class="col-12 text-center">
                      <span class="badge rounded-pill text-primary">Last updated on: <?php echo $upd_date; ?> </span>
                      <img src="<?php echo "../profile/" . $photo; ?>" class="rounded mx-auto d-block" id="img-big" height="390" width="390" alt="No Image">
                      <br>
                      <form action="upd_photo.php<?php echo '?tbl_image_id=' . $id; ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="photo" class="modal-mt" id="card">
                        <input type="submit" id="ba" class="btn btn-primary" style=" --bs-btn-font-size: .90rem;" value="Upload Image" name="upd_photo">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card flex-fill border-0" id="admin">
                <div class="card-body py-4">
                  <div class="">
                    <div class="details">
                      <div class="card-header ">
                        <h6 class="user-profile">User Profile</h6>
                      </div>
                      <br>
                      <form method="post" class="row g-3">
                        <div class="col-md-6">
                          <label for="lib_id">Library ID:</label>
                          <input type="text" class="form-control custom" name="lib_id" value="<?php echo $lib_id; ?>" />
                        </div>
                        <div class="col-md-6">
                          <label for="year">Year Level:</label>
                          <input type="text" class="form-control custom" name="year_level" value="<?php echo $year_level; ?>" />
                        </div>
                        <div class="col-md-6">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control custom" name="email" value="<?php echo $email; ?>" />
                        </div>
                        <div class="col-md-6">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control custom" name="password" value="<?php echo $password; ?>" />
                        </div>
                        <div class="col-md-5">
                          <label for="name" class="text-right">First Name:</label>
                          <input type="text" class="form-control custom" name="fname" value="<?php echo $fname; ?>" />
                        </div>
                        <div class="col-md-3">
                          <label for="name" class="text-left">Middle Name:</label>
                          <input type="text" class="form-control custom" name="mdname" value="<?php echo $mdname; ?>" />
                        </div>
                        <div class="col-md-4">
                          <label for="name" class="text-right">Last Name:</label>
                          <input type="text" class="form-control custom" name="lname" value="<?php echo $lname; ?>" />
                        </div>
                        <div class="col-12">
                          <label for="address">Address:</label>
                          <input type="text" class="form-control custom" name="address" value="<?php echo $address; ?>" />
                        </div>
                        <div class="col-md-6">
                          <label for="phone">Phone No:</label>
                          <input type="text" class="form-control custom" name="mobile" value="<?php echo $mobile; ?>" />
                        </div>
                        <div class="col-md-4">
                          <label for="gender">Gender</label>
                          <select name="gender" class="form-select">
                            <option value=""><?php echo $gender; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-6">
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