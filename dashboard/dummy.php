<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!class_exists('../PHPMailer\PHPMailer\Exception')) {
    include '../PHPMailer/config.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
}
include('../includes/connection.php');


function sendCustomMailClient()
{
    $mail = new PHPMailer;
    $mail->isMail();
    $mail->setFrom("no-reply@theluxurygarage.in", "school management");
   
    $mail->addAddress("priyanka.calinfo500@gmail.com", "priyanka");
    $mail->Subject = "Peilyanoa";
    $user_details = "A new query has been Submitted";
    $mail->msgHTML("<p>Hlo student</p>
");
    $mail->AltBody = 'This is a plain-text message body';
    if ($mail->send()) {
        $message1 = "success";
    } else {

        $message1 = $mail->ErrorInfo;
    }
    return $message1;
}
sendCustomMailClient();
