<?php

$name = $_POST["name"];
$email = $_POST["email"];
$nsubject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "heyyopewdiepie2015@gmail.com";
$mail->Password = "udno nynj zlvd fhos";

$mail->setFrom($email, $name);
$mail->addAddress("cnlallavan03149@usep.edu.ph");

$mail->Subject = $subject;
$mail->Body = $email . $message;

$mail->send();

header("Location: sent.html");