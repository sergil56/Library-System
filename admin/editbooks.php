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