<?php

	$to      = 'yourname@yourdomain.com';
	$subject = $_POST['subject'];
	$message = nl2br($_POST['message']);
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: '.$_POST['mail'] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

	header('location: index.html');

?>
