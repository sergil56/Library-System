
<?php
require_once 'includes/conn.php';
if (isset($_POST['register'])) {
  //form data

  $lib_id = $_POST['lib_id'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $mdname = $_POST['mdname'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $year_level = $_POST['year_level'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];



  $photo = $_FILES['photo'];
  $img_loc = $_FILES['photo']['tmp_name'];
  $photo = $_FILES['photo']['name'];
  $img_des = "../profile/". $photo;
  move_uploaded_file($img_loc, '../profile/' .$photo);


  //insert data into database
  $query = "INSERT INTO users (lib_id,password,fname,lname,mdname,mobile,photo,email,year_level,address,gender) 
  VALUES('$lib_id','$password','$fname','$lname', '$mdname', '$mobile','$img_des','$email','$year_level','$address','$gender')";
  $result = mysqli_query($conn, $query);

   if ($result) {
    header("Location: manageusers.php?success=Successfully Added User");
  } else {
    header("Location: manageusers.php?error=FAILED");mysqli_error($conn);
  }
}
?>
  
<script src="assets/js/sweetalert.js"></script>

