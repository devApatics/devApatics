<?php

// DB Configuration
$servername = "localhost";
$username = "root";
//$password = "";
$database = "apatics_design";

$conn = new mysqli($servername, $username, '', $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['email']))
{	
	$count = 0;
	$email=$_POST['email'];
	
	if ($result = mysqli_query($conn, "SELECT * FROM contact_details WHERE email ='$email'")) {
		
		$count = mysqli_num_rows($result);
		
		if($count>0){
			echo json_encode(false);
		}else{
			echo json_encode(true);
		}		
	}
	mysqli_close($conn);
}

?>