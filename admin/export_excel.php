<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=book_list.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	require_once 'includes/conn.php';
 
	$output = "";
 
	$output .="
		<table>
			<thead>
				<tr>
                    <th>ID</th>
					<th>ISBN</th>
					<th>Title</th>
					<th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
					<th>Category</th>
					<th>Volume</th>
					<th>Subject</th>
					<th>Edition</th>
				</tr>
			<tbody>
	";
 
	$query = $conn->query("SELECT * FROM `tbl_book`");
	while($fetch = $query->fetch_array()){
 
	$output .= "
				<tr>
					<td>".$fetch['id']."</td>
                    <td>".$fetch['isbnno']."</td>
					<td>".$fetch['book_name']."</td>
					<td>".$fetch['author']."</td>
                    <td>".$fetch['publisher']."</td>
                    <td>".$fetch['year']."</td>
					<td>".$fetch['category']."</td>
					<td>".$fetch['volume']."</td>
					<td>".$fetch['subject']."</td>
					<td>".$fetch['edition']."</td>
				
				</tr>
	";
	}
 
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
 
 
?>