<?php 
include "includes/conn.php";

$id = $_GET['id'];
$query = "DELETE FROM tbl_book WHERE id = $id";
$result = mysqli_query($conn,$query);
if($result){
	header("Location: books.php?delete=Successfully Deleted Book Information");
}
else{
	header("Location: books.php?error=FAILED");mysqli_error($conn);
}
?>
