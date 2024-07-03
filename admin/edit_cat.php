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
include 'includes/conn.php';
$ID = $_GET['id'];
if (isset($_POST["update"])) {

    $cat_name = $_POST['cat_name'];
    $status = $_POST['status'];

    $result = mysqli_query($conn, "update category set cat_name='$cat_name', status='$status' where id='$ID'");

    if ($result) {
        header("Location: addcategory.php?success=Successfully Updated User Information");
    } else {
        header("Location:  addcategory.php?error=FAILED");
        mysqli_error($conn);
    }
}
?>

<?php
$id = $_REQUEST['id'];

$ID = htmlspecialchars(trim($id));
$query = "SELECT * FROM category WHERE id='$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $cat_name = $row['cat_name'];
        $status = $row['status'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category/Subjects Management</title>
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
                    <form method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-user-edit"></i> Edit Category Details
                                    </div>
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control custom" name="cat_name" value="<?php echo $cat_name; ?>" />
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <input type="submit" name="update" class="btn btn-primary" value="Edit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>


<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="asset/js/simple-datatables@latest.js"></script>
<script src="asset/js/datatables-simple-demo.js"></script>
<!-- end -->

</html>