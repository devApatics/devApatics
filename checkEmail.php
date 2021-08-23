<?php

include('config.php'); // Add file for configuration

if(isset($_POST['email'])) // Check is email or not
{	
	$count = 0;
	$email=$_POST['email'];
	
	if ($result = mysqli_query($conn, "SELECT * FROM contact_details WHERE email ='$email'")) {
		
		$count = mysqli_num_rows($result);
		
		if($count>0){
			echo json_encode(false); // If email already taken
		}else{
			echo json_encode(true); //If email is not exist
		}		
	}
	mysqli_close($conn);
}

?>