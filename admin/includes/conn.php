<?php

$conn = mysqli_connect ('localhost','root','','libsys');

		if(mysqli_connect_errno()){
			die (mysqli_connect_error(). "Failed to connect");
		}
		
?>