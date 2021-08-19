<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
if (!empty($_POST['g-recaptcha-response'])) {
	$secret = '6Le5poEbAAAAAOlJ8sYT6zJie-QoAVjtNrMx_LKm';
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
	$responseData = json_decode($verifyResponse);
	// Mail Configuration
	$mail = new PHPMailer();
	$mail->isSMTP();                      // Set mailer to use SMTP 
	$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
	$mail->SMTPAuth = true;               // Enable SMTP authentication 
	$mail->Username = 'managedservices@apatics.net';   // SMTP username 
	$mail->Password = 'nikjoilrzexvvdsf';   // SMTP password 
	$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
	$mail->Port = 587;                    // TCP port to connect to 

	// DB Configuration
	$servername = "localhost";
	$username = "root";
	//$password = "";
	$database = "apatics_design";

	$conn = new mysqli($servername, $username, '', $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$name = $_POST['name'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	$state = $_POST['state'];

	if (in_array("Schedule a FREE provider network data integrity scan", $_POST['type'])) {
		$check1 = "Schedule a FREE provider network data integrity scan";
	} else {
		$check1 = NULL;
	}
	if (in_array("Schedule a FREE FWA network detection scan", $_POST['type'])) {
		$check2 = "Schedule a FREE FWA network detection scan";
	} else {
		$check2 = NULL;
	}
	if (in_array("Schedule a consultation and demonstration", $_POST['type'])) {
		$check3 = "Schedule a consultation and demonstration";
	} else {
		$check3 = NULL;
	}
	if (in_array("Register for our e-news bulletin", $_POST['type'])) {
		$check4 = "Register for our e-news bulletin";
	} else {
		$check4 = NULL;
	}

	$sql = "INSERT INTO contact_details (user_name, company, email, phone_no, city, state, data_integrity, network_detection, consultation_demonstration, e_news_bulletin, page_type)
VALUES ('$name', '$company', '$email', '$phone' , '$city' , '$state' , '$check1' , '$check2' ,'$check3' ,'$check4', 'contact_page')";



	if (mysqli_query($conn, $sql)) {
		$mail->setFrom($email);
		$mail->addAddress('managedservices@apatics.net');
		$mail->isHTML(true);
		$mail->Subject = 'Info Request';

		// Mail body content 
		$bodyContent = '<h3>Details</h3>';
		$bodyContent .= '<ul><li>Name:' . $name . '</li>
		<li>Company: ' . $company . '</li>
		<li>Phone: ' . $phone . '</li>
		<li>Email: ' . $email . '</li>
		<li>City: ' . $city . '</li>
		<li>State: ' . $state . '</li>
	</ul>';
		$bodyContent .= '<h3>I am interested in</h3>';
		$bodyContent .= '<ul>';
		if (!is_null($check1))
			$bodyContent .= '<li>' . $check1 . '</li>';
		if (!is_null($check2))
			$bodyContent .= '<li>' . $check2 . '</li>';
		if (!is_null($check3))
			$bodyContent .= '<li>' . $check3 . '</li>';
		if (!is_null($check4))
			$bodyContent .= '<li>' . $check4 . '</li>';
		$bodyContent .= '</ul>';

		$mail->Body = $bodyContent;

		if ($mail->send()) {

			// Mail Configuration
			$mail = new PHPMailer();
			$mail->isSMTP();                      // Set mailer to use SMTP 
			$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
			$mail->SMTPAuth = true;               // Enable SMTP authentication 
			$mail->Username = 'managedservices@apatics.net';   // SMTP username 
			$mail->Password = 'nikjoilrzexvvdsf';   // SMTP password 
			$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
			$mail->Port = 587;                    // TCP port to connect to 

			$mail->setFrom('managedservices@apatics.net');
			$mail->addAddress($email);
			$mail->isHTML(true);
			$mail->Subject = 'Thank You!';

			// Mail body content 
			$bodyContent = '<h3>Thank you for connecting with us !</h3>';

			$mail->Body = $bodyContent;

			if ($mail->send()) {
				echo json_encode(1);
			} else {
				echo json_encode(2);
			}
		} else {
			echo json_encode(2);
		}
	}
} else {
	echo json_encode(0);
}
