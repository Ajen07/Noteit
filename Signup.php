<?php
@include 'config/database.php';
?>
<?php
$name = $age = $email = $password = '';
$nameErr = $ageErr = $emailErr = $passwordErr = '';
$error=false;

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']);

    $select = "SELECT * FROM `registeredusers`";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['email'] == $email) {
                $emailErr='User already exist';
                $error=true;
                break;
            }
        }
    } 
    if (!empty($name) && !empty($age) && !empty($email) && !empty($password)&& !$error) {
        $v_code=bin2hex(random_bytes(6));
        $sql = "INSERT INTO registeredusers (name,age,email,password,verification_code,is_verified) VALUES ('$name','$age','$email','$password','$v_code','0')";
        $create = "CREATE TABLE `notes`.`$email` (`sl_no` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(256) NOT NULL , `description` VARCHAR(256) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sl_no`)) ";
        $result = mysqli_query($conn2, $create);
        if (mysqli_query($conn, $sql) && $result) {
            header('Location: Login.php');
        } else {
            echo 'Error' . mysqli_error($conn);
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
    <link rel="stylesheet" href="./CSS/signup.css">
    <title>SIGNUP FORM</title>
</head>

<body>
    <main class="container">
        <form   method="POST">
            <?php
                if ($error) {
                    echo "<p class='error'>$emailErr </p>";
                }

            ?>
            

            <div>
                <label for="name">Name </label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="age">Age </label>
                <input type="text" id="age" name="age" required>
            </div>
            <div>
                <label for="email">Email </label>
                <input type="text" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password </label>
                <input type="password" id="password" name="password" required>
            </div>

            <input type="submit" value="SIGN UP" name="submit" class="signup-btn">
            <p>Already have an account?<a href="Login.php" style="text-decoration: none;color:red">Login</a></p>

        </form>
    </main>
</body>

</html>