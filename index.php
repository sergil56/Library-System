<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>MNHS Library Portal</title>
  <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin/assets/bootstrap/dist/css/bootstrap.min.css" class="">
  <link rel="icon" href="admin/assets/img/libhub-logo.png">
  <link rel="stylesheet" href="admin/assets/css/style.css" class="rel">
  <link rel="stylesheet" href="admin/assets/fontawesome/css/all.css" class="">
  <link rel="stylesheet" href="vendor/animate.css" class="rel">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">
</head>

<body>
  <style>
    body {
      background-image: url('admin/assets/img/lib1.jpg');
      background-size: cover;
      background-position: center;
      filter: brightness(-8px);
    }

    .navbar-brand {
      padding-left: 30px;

    }

    #signup {
      color: white;
      background-color: #2627e6;
    }

    .nav {
      padding-right: 30px;
    }

    .nav-link {
      color: white;
    }

    .nav-link:hover {
      color: #e10017;
    }

    .logos {
      padding: 12px;
      height: 250px;

    }

    .main:before {
      content: "";
      background-color: rgba(0, 54, 175, .75);
      position: absolute;
      left: 2rem;
      bottom: .20rem;
      right: 2rem;
      top: 0;
    }

    h1 {
      font-family: 'Open Sans', 'Helvetica Neue', 'Segoe UI', Helvetica, Arial, sans-serif;
      font-weight: 300px;
      font-size: 70px;
      margin: 0;
    }

    center h3 {
      font-family: 'Open Sans', 'Helvetica Neue', 'Segoe UI', Helvetica, Arial, sans-serif;
      font-size: 2.5rem;
      padding-top: 60px;
      margin: 20px 20px 12px;
      font-weight: 300;
    }

    .card {
      border-radius: 12px;
    }

    #content {
      transform: scale(.9, .9);
      color: white;
    }

    .register-button,
    .login-button {
      transition: background .4s ease-in-out, border .4s ease-in-out, color .4s ease-in-out, .4s ease-in-out;
    }

    .t-Button--large {
      font-size: .9rem;
      border-radius: 1rem !important;
      margin-top: 40px;
      padding: 0.5rem 2rem;
      box-shadow: none;
    }

    .register-button {
      color: white;
      border: solid 0.5px #e10017;
      border-radius: 3px;
      padding: 15px 50px;
      background-color: #f22011;
    }

    .register-button:hover {
      color: white;
      background-color: #c50d00bd;

    }

    .login-button {
      background-color: rgb(255, 255, 255, 0);
      color: white;
      border: solid 0.5px;
      border-radius: 3px;
      padding: 15px 50px;
      background: transparent;
    }

    .login-button:hover {
      color: white;
      background-color: rgb(255, 255, 255, 0.5);
    }

    .content button {
      font-size: .9rem;
      font-weight: 700;
      margin-top: 40px;
      margin-right: 20px;
      line-height: 2;
    }

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

  <div class="blur-bg-overlay ">
    <nav class="navbar sticky-top navbar-expand ">
      <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand" href="user/dashboard.php">
              <img class="logo" src="admin/assets/img/libhub-logo.png" />
              <h8>MNHS Library Portal</h8>
            </a>
          </li>
        </ul>
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link" href="books.php">Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="main">
      <main class="content px-3 py-2">
        <center>
          <div class="content animate__animated animate__fadeInUp" id="content">
            <h3>Manjuyod National High School Library System</h3>
            <img class="logos" src="admin/assets/img/libhub-logo.png" />
            <h1>
              <b>MNHS Library Portal</b>
            </h1>
            <div class="container">
              <div class="row">
                <div class="col col-12 apex-col-auto">
                  <button class="register-button  t-Button--large" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span>REGISTER NOW</span></button>
                  <button class="login-button  t-Button--large" type="button" data-bs-toggle="modal" data-bs-target="#staticLogin"><span>LOG IN</span></button>
                </div>
              </div>
            </div>
          </div>
        </center>
      </main>
    </div>
  </div>
</body>

<!-- modal login -->
<div class="modal fade bd-example-modal-lg" id="staticLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="form-popup">
        <div class="form-box login">
          <div class="form-details">
          </div>
          <div class="form-content">
            <h3>LOG IN</h3>
            <form action="user/userlogin.php" method="POST">
              <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
              <div class="input-field">
                <input type="email" name="email" placeholder="" required>
                <label>Enter Your Email</label>
              </div>
              <div class="input-field">
                <input type="password" name="password" id="myInput" placeholder="" required>
                <label>Enter Your Password</label>
              </div>
              <input type="checkbox" onclick="myFunction()"> Show Password</input>
              <br>
              <br>
              <input type="button" value="Cancel" class="btn btn-danger" data-bs-dismiss="modal"></input>
              <input type="submit" onclick="sweet()" value="Log In" class="btn btn-primary"></input>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end -->





<!-- Add user -->
<div class="modal fade bd-example-modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="user/add.php" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="form-box login">
          <div class="form-details">
          </div>
          <div class="form-content">
            <h3>SIGN UP</h3>
            <div class="card-header" id="signup">
              <i class="fa-solid fa-signup"></i> Personal Information
            </div>
            <div class="card-body">
              <div class="col">
                <div class="form-group ">
                  <label>Library ID</label>
                  <input type="text" class="form-control" value="MAN" name="lib_id" maxlength="155" aria-required="true" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="fname" maxlength="30" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" name="mdname" maxlength="30" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="lname" maxlength="30" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Mailing Address</label>
                    <input type="text" class="form-control" name="address" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Year Level</label>
                    <input type="text" class="form-control" name="year_level" maxlength="30" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobile" maxlength="155" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label>Gender</label>
                    <select name="gender" class="form-select">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
              </div>
              <br>
            </div>
            <div class="card-header" id="signup">
              <i class="fa-solid fa-signup"></i> Account Information
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" aria-required="true" required>
                    <div class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" aria-required="true" required>
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
                        <input type="file" name="photo" id="fileImg" aria-required="true" >
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
            <div class="modal-footer">
              <input type="button" value="Cancel" class="btn btn-danger" data-bs-dismiss="modal"></input>
              <input type="submit" name="register" onclick="sweet()" value="Register" class="btn btn-primary"></input>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- end of modal -->
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