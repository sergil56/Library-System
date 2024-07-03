<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MNHS Library System</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="assets/img/libhub-logo.png">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
</head>

<body>

  <style>
    body {
      background-image: url('assets/img/lib1.jpg');
      background-size: cover;
      background-position: center;

    }
  </style>

  <!-- Login Form -->
  <div class="blur-bg-overlay">
    <div class="form-popup">
      <div class="form-box login">
        <div class="form-details">
        </div>
        <div class="form-content">
          <h2><b>ADMIN LOGIN</b></h2>
          <form action="adminlogin.php" method="POST">
            <?php if (isset($_GET['error'])) { ?>
              <p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
            <div class="input-field">
              <input type="text" name="username" placeholder="" required>
              <label>Enter Your username</label>
            </div>
            <div class="input-field">
              <input type="password" name="password" id="myInput" placeholder="" required>
              <label>Enter Your Password</label>
            </div>
            <input type="checkbox" onclick="myFunction()"> Show Password
            <button class="btn btn-primary" type="submit">Log In</button>
          </form>
          <div class="bottom-link">
            <div class="gap-40"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end of login form -->

  <!-- modal -->

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" id="formbox">
        <!-- <button type="button" class="btn-close" id="regbtn" data-bs-dismiss="modal" aria-label="Close">close</button> -->
        <span class="close-btn material-symbols-rounded" data-bs-dismiss="modal">close</span>
        <div class="form-content">
          <h2>SIGN UP</h2>
          <form action="add.php" method="POST">
            <div class="input-field">
              <input type="text" name="username" placeholder="" required>
              <label>Create Your UserName</label>
            </div>
            <div class="input-field">
              <input type="password" name="password" placeholder="" required>
              <label>Create Your Password</label>
            </div>
            <div class="input-field">
              <input type="email" name="email" placeholder="" required>
              <label>Enter Your Email</label>
            </div>
            <div class="input-field">
              <input type="text" name="grade" placeholder="" required>
              <label>Year Level</label>
            </div>
            <button type="submit" name="register"> Register </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end of modal -->

  <!-- script -->
  <script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>