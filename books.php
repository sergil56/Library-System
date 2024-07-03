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

    .card-content {
      width: 100%;
      height: 100%;
    }

    .main-panel {
      margin: 0;
      width: 100%;
    }

    .card-list {
      margin: 20px;
    }

    .btn-sm {
      float: right !important;
    }

    .card-title {
      white-space: nowrap;
      overflow: hidden;
      max-width: 100%;
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
      bottom: .9rem;
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
    
  </div>
</body>

<!-- script -->
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="admin/assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="admin/assets/js/script.js"></script>
<script src="admin/assets/js/sweetalert.js"></script>
<!-- end -->

</html>