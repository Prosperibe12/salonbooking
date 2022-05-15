<?php 
	ob_start();
	//Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require '../vendor/autoload.php';

	// start session
	session_start();

	// dump request
	var_dump($_REQUEST);
	
	include_once('service_provider_payclass.php');

	//include email template
    $template_file ="./payment_temp.php";

	$objVerify = new Payment;

	$outcome = $objVerify->verifyTrans($_REQUEST['reference']);

	if ($outcome->data->status === 'success') {

		$updatestat = $objVerify->upDateTrans($_REQUEST['reference']);

		if ($updatestat === true) {
			// send email payment notification to service provider
			echo "<div style='display: none;'>";

			// create instance of phpmailer
			$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;

					//Enable verbose debug output
					$mail->isSMTP();

					// Send using SMTP
					$mail->Host       = 'smtp.gmail.com';

					//Set the SMTP server to send through
					$mail->SMTPAuth   = true;

					//SMTP username
					$mail->Username   = 'Prosperibe12@gmail.com';

					//SMTP password
					$mail->Password   = 'vgkbkwelakcuzikw';

					$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

					//Enable implicit TLS encryption
					$mail->Port       = 465;

					//Recipients
					$mail->setFrom('Prosperibe12@gmail.com');
					$mail->addAddress($_SESSION['salon_email']);

					//Set email format to HTML
					$mail->isHTML(true);

					$mail->Subject = 'SUBSCRIPTION PAYMENT';

					// check if email template exist & get content of email template
					if (file_exists($template_file)) {
						$message = file_get_contents($template_file);
					}

					// create swap variables
					$swap_var = array(
						'{SITE_ADDR}' => 'https://mem.com.ng',
						'{EMAIL_LOGO}' => 'http://localhost/salonbk/assets/img/cover.png', 
						'{VER_LINK}' => 'http://localhost/salonbk/verify_account.php?verification='.$code.'',
						'{FONTAWESOME_LINK}' => 'https://kit.fontawesome.com/c9f8e4d2b3.js'
					);

					// search and replace swap variables with its value pair
					foreach (array_keys($swap_var) as $key) {
						if (trim($key) != '') {
							$message = str_replace($key, $swap_var[$key], $message);
						}
					}


					$mail->Body    = $message;

					$mail->send();

					echo 'Message has been sent';
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			echo "</div>";

			// redirect to dashboard
			header("Location: http://localhost/salonbk/dashboard/serviceprovider.php");
			exit;
		}
	}

	echo "<pre>";
	print_r($outcome);
	echo "</pre>";

	ob_flush();
?>