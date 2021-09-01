<?php

	// --------------------------------- Mail configuration --------------------------------//
 
	//Client mail cred.
	$mail_user_name = getenv("smtpEmail"); // SMTP username 
	$mail_password = getenv("smtpPWD"); // SMTP password 

	$to_admin_email = getenv("toEmail"); // Set this to email send to admin 

	// -------------------------------Google captcha--------------------------------------// 
	
  	$google_secret_key = getenv("googleSecretKey");
	
	// ----------------------------------- DB Configuration -----------------------------------// 
	// DB Cred.
	$servername = getenv("host"); 
	$username = getenv("UId");
	$password = getenv("dbPWD");
	$database = getenv("database"); 
	

	$conn = new mysqli($servername, $username, $password, $database); // For DB Connection

	// Check DB connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>