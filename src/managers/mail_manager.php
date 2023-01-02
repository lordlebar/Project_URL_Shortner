<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require_once(realpath(dirname(__FILE__) . "/../../../vendor/autoload.php"));

	function send_mail_to($email, $subject, $content)
	{
		$mail = new PHPMailer(true);
        	try
        	{
			$from = "no-replay@" . $_SERVER["HTTP_HOST"];
			$mail->setFrom($email, "Mailer"); // no-reply@corentin.lebarilier.13h37.io // no-reply@ACQTX.com
			$mail->addAddress($email);
			$mail->Subject = $subject;
			$mail->Body = $content;
			$mail->send();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			exit();
		}
	}
?>
