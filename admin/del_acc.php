
<?php
include "includes/conn.php";

$id = $_GET['user_id'];
$query = "DELETE FROM users WHERE user_id = $id";
$result = mysqli_query($conn, $query);

if ($result) {
  header("Location: manageusers.php?delete=Data Deleted Successfully!");
} else {
  header("Location: manageusers.php?error=FAILED");
  mysqli_error($conn);
}

?>