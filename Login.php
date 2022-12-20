<?php
@include_once 'config/database.php';
session_start();
?>

<?php
$emailErr = $passwordErr = $ver_msg = '';
$emailexist = true;
$correctPass = true;
$emailnotfound = 0;
$ver_status = 0;


if (isset($_POST['submit'])) {
    /*  $email = $password = ''; */



    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']);
    if (!empty($email) && !empty($password)) {
        $select = "SELECT * FROM `registeredusers`";
        $result = mysqli_query($conn, $select);
        $count = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                if ($row['email'] == $email && $row['password'] == $password && $row['is_verified'] == 1) {
                    $_SESSION['user_name'] = strtoupper($row['name']);
                    $_SESSION['user_email'] = $row['email'];
                    header('Location: Content.php');
                } elseif ($row['email'] == $email && $row['is_verified'] == 0) {
                    $ver_msg = 'Email Not Verified';
                    $_SESSION['code'] = $row['verification_code'];
                    $_SESSION['user_email'] = $email;
                } elseif ($row['email'] == $email && $row['password'] != $password && $row['is_verified'] == 1) {
                    $ver_status = 1;
                    $correctPass = false;
                    $passwordErr = 'Incorrect password';
                } elseif ($row['email'] != $email) {
                    $emailnotfound++;
                }
            }
        }
        if ($emailnotfound == $count) {
            $emailexist = false;
            $emailErr = 'Email is not Registereed';
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
    <title>LOGIN</title>
</head>

<body>
    <main class="container">
        <form method="POST">
            <?php
            if (isset($_POST['submit'])) {
                if (!$emailexist) {
                    echo "<p class='error'>$emailErr</p>";
                } elseif ($ver_status == 1) {
                    if (!$correctPass) {
                        echo "<p class='error'>$passwordErr</p>";
                    }
                }
                if (!empty($ver_msg)) {
                    echo "<p class='error'>$ver_msg <a style='text-decoration: none;color:blue' href='verify.php?email=$email'>click to verify</a></p>";
                }
            }


            ?>
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <?php
            if ($ver_status == 1 && !$correctPass) {

                echo "<a  href='forgot.php' style='text-decoration: none;color:purple'>Forgot Password?</a>";
            }

            ?>
            <input type="submit" value="LOGIN" name="submit" class="login-btn">
            <p>Don't have an account?<a href="Signup.php" style="text-decoration: none;color:red">Sign up</a></p>
        </form>

    </main>


</body>

</html>