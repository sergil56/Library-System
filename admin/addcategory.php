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
require_once 'includes/conn.php';
if (isset($_POST['addcat'])) {
    //form data

    $cat_name = $_POST['cat_name'];
    $status = $_POST['status'];


    //insert data into database
    $result = mysqli_query($conn, "insert into category set cat_name='$cat_name', status='$status'");

    if ($result) {
        header("Location: addcategory.php?success=Successfully Added Category");
    } else {
        header("Location: addcategory.php?error=FAILED");
        mysqli_error($conn);
    }
}
?>

<?php
if (isset($_GET['id'])) {
    require_once 'includes/conn.php';
    $ID = $_GET['id'];

    $ID = htmlspecialchars(trim($ID));
    $query = "SELECT * FROM category WHERE id='$ID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $cat_name = $row['cat_name'];
            $status = $row['status'];
        }
    }
} else {
    header('addcategory.php');
}
?>
<?php
if (isset($_GET['id'])) {
    require_once 'includes/conn.php';
    $ID = $_GET['id'];

    $ID = htmlspecialchars(trim($ID));
    $query = "SELECT * FROM subject WHERE id='$ID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $sub_name = $row['sub_name'];
            $status = $row['status'];
        }
    }
} else {
    header('addcategory.php');
}
?>
<?php
require_once 'includes/conn.php';
if (isset($_POST['addsub'])) {
    //form data

    $sub_name = $_POST['sub_name'];
    $status = $_POST['status'];


    //insert data into database
    $result = mysqli_query($conn, "insert into subject set sub_name='$sub_name', status='$status'");

    if ($result) {
        header("Location: addcategory.php?success=Successfully Added Subject");
    } else {
        header("Location: addcategory.php?error=FAILED");
        mysqli_error($conn);
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
                <div class="mb-3">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="landingpage.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Category/Subjects</li>
                    </ul>
                </div>
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
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-6">
                                    <i class="fas fa-table me-1"></i> Category Management
                                </div>
                                <div class="col col-md-6" align="right">
                                    <button class="btn btn-success btn-small float-end" data-bs-toggle="modal" data-bs-target="#popOver"><span class="fa fa-plus"></span>Add Category</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php include 'includes/conn.php';
                            $sql = "SELECT * FROM category"; ?>
                            <?php $result = $conn->query($sql);
                            if ($result->num_rows > 0) { ?>

                                <table class="table table-hover text-justified" id="datatablesSimple">
                                    <thead>
                                        <th>Category Name</th>
                                        <th>Created On</th>
                                        <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sn = 1;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-justified"><?php echo $row['cat_name']; ?></td>
                                                <td class="text-justified"><?php echo $row['created_at']; ?></td>
                                                <td class="text-justified"><a href="edit_cat.php?id=<?php echo $row['id']; ?>"><button type="submit" id="ba" class="btn btn-success" style=" --bs-btn-font-size: .75rem;"><b>Edit</b> </button></a>
                                                    <a href="del_cat.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Do you really want to Delete ?');"><button type="submit" id="br" class="btn btn-danger" style=" --bs-btn-font-size: .75rem;"><b>Delete</b> </button></a>
                                                </td>
                                                <?php $sn++;
                                                ?>
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                } else {
                                    echo " 0 results";
                                }
                                $conn->close();
                                ?>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-6">
                                    <i class="fas fa-table me-1"></i> Subject Management
                                </div>
                                <div class="col col-md-6" align="right">
                                    <button class="btn btn-success btn-small float-end" data-bs-toggle="modal" data-bs-target="#popUnder"><span class="fa fa-plus"></span>Add Subject</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php include 'includes/conn.php';
                            $sql = "SELECT * FROM subject"; ?>
                            <?php $result = $conn->query($sql);
                            if ($result->num_rows > 0) { ?>

                                <table class="table table-hover text-justified" id="datatablesSimple">
                                    <thead>
                                        <th>Subject</th>
                                        <th>Created On</th>
                                        <th colspan="2">Action</th>
                                        </tr>
                                    </thead>


                                    <?php
                                    $sn = 1;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-justified"><?php echo $row['sub_name']; ?></td>
                                                <td class="text-justified"><?php echo $row['created_at']; ?></td>
                                                <td class="text-justified"><a href="edit_sub.php?id=<?php echo $row['id']; ?>"><button type="submit" name="update" id="ba" class="btn btn-success" style=" --bs-btn-font-size: .75rem;"><b>Edit</b> </button></a>
                                                    <a href="del_cat.php?ids=<?php echo $row['id']; ?>" onclick="return confirm('Do you really want to Delete ?');"><button type="submit" id="br" class="btn btn-danger" style=" --bs-btn-font-size: .75rem;"><b>Delete</b> </button></a>
                                                </td>
                                                <?php $sn++;
                                                ?>
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                } else {
                                    echo " 0 results";
                                }
                                $conn->close();
                                ?>
                                </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<div class="modal fade" id="popOver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i> Add Category Details
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control custom" name="cat_name" />
                            </div>
                            <div class="mt-4 mb-0">
                                <input type="submit" name="addcat" class="btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="popUnder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i> Add Subject Details
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <label class="form-label">Subject Name</label>
                                <input type="text" class="form-control custom" name="sub_name" />
                            </div>
                            <div class="mt-4 mb-0">
                                <input type="submit" name="addsub" class="btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- script -->
<script src="assets/bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="asset/js/simple-datatables@latest.js"></script>
<script src="asset/js/datatables-simple-demo.js"></script>
<!-- end -->

</html>