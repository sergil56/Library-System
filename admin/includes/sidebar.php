<link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
<?php
$session = $_SESSION['id'];
include 'includes/conn.php';
$result = mysqli_query($conn, "SELECT * FROM admins where id= '$session'");
while ($row = mysqli_fetch_array($result)) {
    $sessionuname = $row['username'];
    $sessionname = $row['name'];
    $sessionemail = $row['AdminEmail'];
    $sessionphoto = $row['photo'];
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
            $regdate = $row['regdate'];
            $photo = $row['photo'];
        }
    }
} else {
    header('manageusers.php');
}
?>
<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100" id="sidebar-link">
        <li class="nav-item nav-profile">
            <div class="profile-image text-center">
                <img src="<?php echo "../profile/" . $sessionphoto; ?>" class="img-xs circle">
            </div>
            <a href="profile.php?id=<?php echo $row['id']; ?>" class="nav-profile">
                <div class="text-center">
                    <p class="profile-name "><?php echo $sessionname ?>
                    <p class="designation"><?php echo $sessionemail; ?></p>
                </div>
            </a>
        </li>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                <span class="nav-link">Administrator</span>
            </li>
            <br>
            <li class="sidebar-item">
                <a href="landingpage.php" class="sidebar-link">
                    <i class="fa-solid fa-table pe-2"></i>
                    Admin Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="import.php" class="sidebar-link" data-bs-target="#pages">
                    <i class="fa-solid fa-file-import pe-2"></i>
                    Import Files
                </a>
            </li>
            <li class="sidebar-item">
                <a href="fines.php" class="sidebar-link" data-bs-target="#pages">
                    <i class="fa-solid fa-money-check-dollar pe-2"></i>
                    Fines
                </a>
            </li>
            <li class="sidebar-item">
                <a href="addcategory.php" class="sidebar-link" data-bs-target="#pages">
                    <i class="fa-solid fa-book-open pe-2"></i>
                    Manage Categories/Subjects
                </a>
            </li>
            <li class="sidebar-item">
                <a href="books.php" class="sidebar-link" data-bs-target="#pages">
                    <i class="fa-solid fa-book pe-2"></i>
                    Manage Books
                </a>
            </li>
            <li class="sidebar-item">
                <a href="books_borrowed.php" class="sidebar-link" data-bs-target="#posts">
                    <i class="fa-solid fa-book-open pe-2"></i>
                    Borrowed Books
                </a>
            </li>
            <li class="sidebar-item">
                <a href="manageusers.php" class="sidebar-link"><i class="fa-solid fa-users pe-2"></i>
                    Registered Users
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="sidebar-link"><i class="fa-solid fa-right-from-bracket pe-2"></i>
                    Log Out
                </a>
            </li>
        </ul>
    </div>
</aside>


<!-- logout modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow" id="modal">
            <div class="modal-body p-4 text-center">
                <h5 class="mb-0">Sure you want to Sign Out?</h5>
            </div>
            <div class="modal-footer flex-nowrap p-0">
                <a href="logout.php" type="button" class="btn btn-lg btn-danger fs-6 text-decoration-none col-6 py-3 m-0 rounded-0">Sign out</a>
                <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end -->