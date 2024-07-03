<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=stud_info.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	require_once 'includes/conn.php';
 
	$output = "";
 
	$output .= "
		<table>
			<thead>
				<tr>
                    <th>ID</th>
                    <th>Library ID</th>
                    <th>Student First Name</th>
                    <th>Student Middle Name</th>
                    <th>Student Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Year Level</th>
                    <th>Address</th>
                    <th>Date Created</th>
				</tr>
			<tbody>
	";
 
	$query = $conn->query("SELECT * FROM `users`");
	while($fetch = $query->fetch_array()){
 
	$output .= "
				<tr>
					<td>".$fetch['user_id']."</td>
                    <td>".$fetch['lib_id']."</td>
					<td>".$fetch['fname']."</td>
					<td>".$fetch['mdname']."</td>
                    <td>".$fetch['lname']."</td>
                    <td>".$fetch['email']."</td>
					<td>".$fetch['mobile']."</td>
					<td>".$fetch['year_level']."</td>
					<td>".$fetch['address']."</td>
					<td>".$fetch['regdate']."</td>
				
				</tr>
	";
	}
 
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
 
 
?>