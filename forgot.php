<?php
@include 'config/database.php';
session_start();

/* $user_mail=$_SESSION['user_email']; */

if (isset($_POST['submit'])) {
  
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['new_pass']);
    $cpassword=md5($_POST['con_pass']);

    if (!empty($email) && !empty($password) &&!empty($cpassword) && $cpassword==$password) {
        $query="UPDATE `registeredusers` SET `password`='$password' WHERE email='$email'";
        $result=mysqli_query($conn,$query);
        if($result){
            header('Location:verified.php');
        }
    }
    elseif (!empty($email) && !empty($password) &&!empty($cpassword) && $cpassword!=$password) {
        echo"<script>alert('Password not matched')</script>";
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
        <form  method="post" style="height: 50vh; padding:1rem">
            <label for="email">Enter Registered Email Id</label>
            <input type="text" id="email" name="email" required style="text-align: center">
            <label for="new_pass">New Password</label>
            <input type="password" id="new_pass" name='new_pass' required style="text-align: center">
            <label for="con_pass">Confirm Password</label>
            <input type="password" id="con_pass" name='con_pass' required style="text-align: center">
            <input type="submit" value="CHANGE" name="submit" style="width:25% ;color: black;background-color:  rgb(248, 248, 156);font-weight:800" onMouseOver="this.style.backgroundColor='#f6f600'" onMouseOut="this.style.backgroundColor='#f8f89c'">
        </form>
    </main>
    
</body>
</html>