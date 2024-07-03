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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Lists</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
  <link rel="icon" href="assets/img/libhub-logo.png">
  <link rel="stylesheet" href="assets/css/style2.css" class="rel">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
</head>
<style>
   .upload {
      width: 140px;
      position: relative;
      margin: auto;
      text-align: center;
    }

    .upload img {
      border-radius: 50%;
      border: 8px solid #DCDCDC;
      width: 125px;
      height: 125px;
    }

    .upload .rightRound {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #00B4FF;
      width: 32px;
      height: 32px;
      line-height: 33px;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }

    .upload .leftRound {
      position: absolute;
      bottom: 0;
      left: 0;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }

    .upload .fa {
      color: white;
    }

    .upload input {
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }

    .upload input::-webkit-file-upload-button,
    .upload input[type=submit] {
      cursor: pointer;
    }
</style>
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
              <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
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
                <td style="font-size: large; ">
                  <button class="btn btn-success btn-small float-end" style=" --bs-btn-font-size: .75rem;" data-bs-toggle="modal" data-bs-target="#popOver"><span class="fa fa-plus"></span><b> Add User</b></button>
                </td>
                <td style="font-size: large;">
                  <a href="export_user.php"><button type="submit" name="send" onclick="return confirm('Export Users Infromation to Excel ?');" class="btn btn-success float-end" style=" --bs-btn-font-size: .75rem;margin-right:10px;"><b>Export User Informations To Excel</b> </button></a>
                </td>
              </div>
              <i class="fa fa-info-circle"></i>
              Registered Users
            </div>

            <div class="card-body">
              <div class="table-responsive" id="card">
                <?php include 'includes/conn.php'; ?>
                <?php $results = mysqli_query($conn, "SELECT * FROM users"); ?>
                <table class="table table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Library ID</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Year Level</th>
                      <th>Register Date</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <?php while ($row = mysqli_fetch_array($results)) { ?>
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
                            <a href="viewprofile.php?user_id=<?php echo $row['user_id']; ?>" id="action">
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
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Add user -->
        <div class="modal fade bd-example-modal-lg" id="popOver" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="add.php" method="POST" enctype="multipart/form-data">
              <div class="modal-content">
                <div class="card">
                  <div class="card-header">
                    <i class="fa-solid fa-circle-info"></i> Personal Information
                  </div>
                  <div class="card-body">
                    <div class="col">
                      <div class="form-group ">
                        <label>Library ID</label>
                        <input type="text" class="form-control" value="MAN" name="lib_id" maxlength="155" aria-required="true">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="fname" maxlength="30" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Middle Name</label>
                          <input type="text" class="form-control" name="mdname" maxlength="30" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="lname" maxlength="30" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Mailing Address</label>
                          <input type="text" class="form-control" name="address" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Year Level</label>
                          <input type="text" class="form-control" name="year_level" maxlength="30" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group ">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" name="mobile" maxlength="155" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <i class="fa-solid fa-circle-info"></i> Account Information
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" aria-required="true">
                          <div class="invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Profile Photo</label>
                          <div class="upload">
                            <img src="" id="image">
                            <div class="rightRound" id="upload">
                              <input type="file" name="photo" id="fileImg" aria-required="true">
                              <i class="fa fa-camera"></i>
                            </div>
                            <div class="leftRound" id="cancel" style="display: none;">
                              <i class="fa fa-times"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="button" value="Cancel" class="btn btn-danger" data-bs-dismiss="modal"></input>
                  <input type="submit" name="register" value="Register" class="btn btn-primary" value="<?= $row['user_id'] ?>" onclick="return confirm('Do you really want to Add User?');"></inp>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- End -->
      </main>
    </div>
  </div>
</body>

<script type="text/javascript">
  document.getElementById("fileImg").onchange = function() {
    document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image

    document.getElementById("cancel").style.display = "block";
    document.getElementById("confirm").style.display = "block";

    document.getElementById("upload").style.display = "none";
  }

  var userImage = document.getElementById('image').src;
  document.getElementById("cancel").onclick = function() {
    document.getElementById("image").src = userImage; // Back to previous image

    document.getElementById("cancel").style.display = "none";
    document.getElementById("confirm").style.display = "none";

    document.getElementById("upload").style.display = "block";
  }
</script>
<!-- script -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="admin/assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/js/script.js"></script>
<script src="admin/assets/js/sweetalert.js"></script>
<!-- end -->

</html>