<?php 
include "includes/conn.php";

$id = $_GET['id'];
$query = "DELETE FROM category WHERE id = $id";
$result = mysqli_query($conn,$query);
if($result){
	header("Location: addcategory.php?delete=Successfully Deleted Category");
}
else{
	header("Location: addcategory.php?error=FAILED");mysqli_error($conn);
}
?>

<?php 
include "includes/conn.php";

$id = $_GET['ids'];
$query = "DELETE FROM subject WHERE id = $id";
$result = mysqli_query($conn,$query);
if($result){
	header("Location: addcategory.php?delete=Successfully Deleted Subject");
}
else{
	header("Location: addcategory.php?error=FAILED");mysqli_error($conn);
}
?>
