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
            $year_level = $row['year_level'];
            $regdate = $row['regdate'];
            $photo = $row['photo'];
        }
    }
} else {
    header('manageusers.php');
}
?>

<form action="insert.php" method="POST">
    <table class="table table-borderless mt-4 ">
        <tbody>
            <tr>
                <th>ID number:</th>
                <td><input type="text" value="<?= $ID; ?>" name="fname" id=""></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><input type="text" value="<?= $fname; ?>" name="fname" id=""></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><input type="text" value="<?= $mdname; ?>" name="mdname" id=""></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><input type="text" value="<?= $lname; ?>" name="lname" id=""></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="text" value="<?= $email; ?>" name="email" id=""></td>
            </tr>
            <tr>
                <th>Mobile Number:</th>
                <td><input type="text" value="<?= $mobile; ?>" name="mobile" id=""></td>
            </tr>
            <tr>
                <th>Year Level:</th>
                <td><input type="text" value="<?= $year_level; ?>" name="year_level" id=""></td>
            </tr>
        </tbody>
    </table>
    <input type="button" value="SUbmit" name="submit">
</form>