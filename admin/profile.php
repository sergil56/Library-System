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
  $sessionmdname = $row['mdname'];
  $sessionlname = $row['lname'];
  $address = $row['address'];
  $phone = $row['mobile'];
  $sessionemail = $row['AdminEmail'];
  $sessionphoto = $row['photo'];
}
?>

<?php
include 'includes/conn.php';
$ID = $_SESSION['id'];

if (isset($_POST["update"])) {

  $username = $_POST['username'];
  $name = $_POST['name'];
  $mdname = $_POST['mdname'];
  $lname = $_POST['lname'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $AdminEmail = $_POST['AdminEmail'];
  $sessionphoto = $_POST['photo'];

  $photo = $_FILES['photo'];
  $img_loc = $_FILES['photo']['tmp_name'];
  $photo = $_FILES['photo']['name'];
  $img_des = "../profile/" . $photo;
  move_uploaded_file($img_loc, '../profile/' . $photo);



  $sql = "UPDATE `admins` SET `username`='$username',`name`='$name',`lname`='$lname',`mdname`='$mdname',`address`='$address',`mobile`='$mobile',`AdminEmail`='$AdminEmail',`photo` =`$img_des`
  WHERE id = $ID";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: profile.php?success=Successfully Updated User Information");
  } else {
    header("Location: profile.php?error=FAILED");
    mysqli_error($conn);
  }
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
          <div class="row">
            <div class="col-lg-6">
              <div class="row">
                <div class="card flex-fill border-0" id="admin">
                  <div class="card-body py-4">
                    <h6 class="user-profile">Admin Photo</h6>
                  </div>

                  <div class="text-right">
                    <div class="col-12 text-center">
                      <img src="<?php echo "../profile/" . $sessionphoto; ?>" class="rounded mx-auto d-block" id="img-big" height="315" width="315" alt="No Image">
                      <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="photo" class="modal-mt" id="card">
                        <input type="submit" id="ba" class="btn btn-primary" style=" --bs-btn-font-size: .75rem;" value="Upload Image" name="submit">
                      </form>
                    </div>
                    <div class="gap-30"></div>
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
                        <h6 class="user-profile">Admin Profile</h6>
                      </div>
                      <br>
                      <form method="post">
                        <div class="form-group">
                          <label for="name" class="text-right">Name:</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $sessionname; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="username">Username:</label>
                          <input type="text" class="form-control custom" placeholder="Username" name="username" value="<?php echo $sessionuname; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="text" class="form-control custom" name="AdminEmail" value="<?php echo $sessionemail; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="phone">Phone No:</label>
                          <input type="text" class="form-control custom" name="mobile" value="<?php echo $phone; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="address">Address:</label>
                          <input type="text" class="form-control custom" name="address" value="<?php echo $address; ?>" />
                        </div>
                        <div class="text-right mt-20">
                          <input type="submit" value="Update" id="ba" style=" --bs-btn-font-size: .75rem;" class="btn btn-primary" name="update">
                        </div>
                        <?php
                        ?>
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