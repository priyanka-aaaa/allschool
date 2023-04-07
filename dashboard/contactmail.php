<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (!class_exists('../PHPMailer\PHPMailer\Exception')) {
    include '../PHPMailer/config.php';
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
}

$content = "";
$usertemp = "";
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

ob_start();
include("../template/feepayment.php");
$content .= ob_get_clean();
// $content="hello";

$mail = new PHPMailer(true);

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->IsHTML(true);

$mail->Username = "parveenk.calinfo@gmail.com";

$mail->Password = "xkevtiqawkkvhwya";

$mail->setFrom("parveenk.calinfo@gmail.com", 'Bharat RERA');
// $mail->addReplyTo($cmail, 'Bharat RERA');

$mail->addAddress("priyanka.calinfo500@gmail.com", 'Bharat RERA');
$mail->Subject = "Bharat RERA";

$mail->Body = $content;



try {
    $mail->send();
} catch (Exception $e) {
    echo $mail->ErrorInfo;
}
