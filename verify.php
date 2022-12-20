<?php
session_start();
@include 'config/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'config/PHPMailer/PHPMailer.php';
require 'config/PHPMailer/SMTP.php';
require 'config/PHPMailer/Exception.php';



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$user_mail=$_SESSION['user_email'];

$code=$_SESSION['code'];

try {
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noteit053@gmail.com';                     //SMTP username
    $mail->Password   = 'pshsjzdlvmuyaujs';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noteit053@gmail.com', 'Note It');
    $mail->addAddress($_SESSION['user_email']);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification';
    $mail->Body    = "Thanks For Registration Your verification code is:$code";

    $mail->send();

    
    echo "<script>alert('Verification code sent to Registered email')</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
<?php
if (isset($_POST['submit'])) {
    if ($code==$_POST['code']) {
       $query="UPDATE `registeredusers` SET `is_verified`='1' WHERE email='$user_mail'";
       $result=mysqli_query($conn,$query);
       if ($result) {
        echo "<script> alert('Verification is Succesfull')</script>";
        header('Location:verified.php');
       }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/login.css">
    <link rel="stylesheet" href="./CSS/verify.css">
    <title>Verification</title>
</head>
<body>
    <main class="container">
        <form  method="post">
            <label for="code">Enter The Verification Code</label>
            <input type="text" id="code" name="code" style="text-align: center;font-size:1.5rem" >
            <input type="submit" value="VERIFY" name="submit" style="width:25% ; color: black;background-color:  rgb(248, 248, 156);font-weight:800" onMouseOver="this.style.backgroundColor='#f6f600'" onMouseOut="this.style.backgroundColor='#f8f89c'">
        </form>
    </main>
    
</body>
</html>