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
	<title>Import Files</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" class="">
	<link rel="icon" href="assets/img/libhub-logo.png">
	<link rel="stylesheet" href="assets/css/style2.css" class="rel">
	<link rel="stylesheet" href="assets/fontawesome/css/all.css" class="">
	<link href="assets/css/jquery.dataTables.min.css" rel="stylesheet">
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
						<li class="breadcrumb-item active" aria-current="page">Import Data</li>
					</ul>
				</div>
				<div class="card ">
					<div class="">
						<?php if (isset($_GET['success'])) { ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong><?php echo $_GET['success']; ?></strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
					</div>
					<div class="">
						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong><?php echo $_GET['error']; ?></strong>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
					</div>
					<div class="card-header">
						<i class="fa-solid fa-file-import"></i>
						Import File to Excel
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-12 mt-4">
								<form action="excelcode.php" method="POST" enctype="multipart/form-data">
									<input type="file" name="import_file" class="form-control" required />
									<input type="submit" id="ba" name="save_excel_data" value="Import" class="btn btn-primary mt-3"></input>
								</form>
								<br>
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