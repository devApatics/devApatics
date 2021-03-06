<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include('config.php'); // Add file for configuration

if (!empty($_POST['g-recaptcha-response'])) //Check the captcha-click or not.
{
	// For google captcha
	$secret = $google_secret_key;
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
	$responseData = json_decode($verifyResponse);
	
	// Mail Configuration
	$mail = new PHPMailer();
	$mail->isSMTP();                      // Set mailer to use SMTP 
	$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
	$mail->SMTPAuth = true;               // Enable SMTP authentication 
	$mail->Username = $mail_user_name;   // SMTP username 
	$mail->Password = $mail_password;   // SMTP password   // SMTP password 
	$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
	$mail->Port = 587;                    // TCP port to connect to 

	// Get Form Data
	$name = $_POST['name'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$city = $_POST['city'];
	$state = $_POST['state'];

	// For all checkboxes
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

	// Insert the record in DB table.
	$sql = "INSERT INTO contact_details (user_name, company, email, phone_no, city, state, data_integrity, network_detection, consultation_demonstration, e_news_bulletin, page_type)
VALUES ('$name', '$company', '$email', '$phone' , '$city' , '$state' , '$check1' , '$check2' ,'$check3' ,'$check4', 'blog_page')";

	if (mysqli_query($conn, $sql)) // Store data in table.
	{
		$_SESSION['is_modal'] = 1; // Store value in seesion for Modal in blogs page 
		$mail->setFrom($email); // sender email
		$mail->addAddress($to_admin_email); // receiver email
		$mail->isHTML(true);
		$mail->Subject = 'Info Request';

		// Mail body content 
		$mail->addEmbeddedImage('images/email_logo.png', 'image_cid');
		
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
		$bodyContent .= '<img src="cid:image_cid" alt="Image" style="margin-top:20px;"/>';
		$mail->Body = $bodyContent;

		if ($mail->send()) {
			// Second mail for Thank you

			// Mail Configuration
			$mail = new PHPMailer();
			$mail->isSMTP();                      // Set mailer to use SMTP 
			$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
			$mail->SMTPAuth = true;               // Enable SMTP authentication 
			$mail->Username = $mail_user_name;   // SMTP username 
			$mail->Password = $mail_password;   // SMTP password   // SMTP password 
			$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
			$mail->Port = 587;                    // TCP port to connect to 

			$mail->setFrom($mail_user_name); // sender email
			$mail->addAddress($email); // receiver email
			$mail->isHTML(true);
			$mail->Subject = 'Thank You!';

			// Mail body content 
			// $bodyContent = '<h3>Thank you for connecting with us !</h3>';
			$mail->addEmbeddedImage('images/email_logo.png', 'image_cid');			
			$bodyContent = '<h4>Hi, '.$name.'</h4>';
			$bodyContent .= '<p>Thank you for contacting APATICS where we are committed to delivering automated data insights that immediately and continuously reduce risk to improve healthcare financial and clinical performance.</p>';
			$bodyContent .= '<p>A member of our executive team will contact you within the next 24 hours to schedule a demonstration at your convenience. We look forward to speaking with you soon.</p>';
			$bodyContent .= '<img src="cid:image_cid" alt="Image" style="margin-top:20px;"/>';
			$mail->Body = $bodyContent;

			if ($mail->send()) {
				echo json_encode(1); //If all process done.
			} else {
				echo json_encode(2); //If has any issue in second mail send
			}
		} else {
			echo json_encode(2); //If has any issue in first mail send
		}
	}
} else {
	echo json_encode(0); // If not checked google captcha
}
