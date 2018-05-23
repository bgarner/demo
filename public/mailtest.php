<?php
$to      = 'brent.garner@fglsports.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: FGL Ops Portal<portal@fglsports.com>' . "\r\n" .
    'Reply-To: no-reply@fglsports.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// The message
$message = "Do not reply to this message\r\n------------------------\r\nLine 1\r\nLine 2\r\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
mail($to, $subject, $message, $headers);
?>