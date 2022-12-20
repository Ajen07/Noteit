<script src="config/editorconfig/ckeditor.js"></script>


<?php
session_start();
@include 'config/database.php';
$title = $_GET['title'];
$email = $_GET['email'];
$sl_no = $_GET['id'];

$select = "SELECT * FROM `$email`";
$result = mysqli_query($conn2, $select);
if (mysqli_num_rows($result) > 0) {
    $select = "SELECT * FROM `$email` WHERE title='$title'";
    $result = mysqli_query($conn2, $select);
    while ($row = mysqli_fetch_assoc($result)) {
        $descp = $row['description'];
    }
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $descp = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
    if ((!empty($title) && empty($descp))||(!empty($title) && !empty($descp))) {
        # code...
        $update = "UPDATE `$email` SET `sl_no`='$sl_no',`title`='$title',`description`='$descp' WHERE `sl_no`='$sl_no'";
        $result = mysqli_query($conn2, $update);
        if ($result) {
            header('Location: content.php');
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
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/notes.css">
    <title>Create Your Notes</title>
</head>

<body>
    <header class="head">
        <div class='logo'>
            <img class='hd-img' src="./images/579703.png" alt="logo">
            <div style="letter-spacing: 0.5rem;">NOTE IT DOWN</div>
        </div>
        <div class="nav">

        </div>
    </header>
    <main class="container">
        <form action="" method="POST">
            <div>
                <label for="title" style="font-size: 2rem">TITLE</label><br>
                <input type="text" id="title" value=<?php echo "$title" ?> name="title"><br>
                <label for="note" style="font-size: 2rem;margin-top:2rem">Write Your Notes Hear</label><br>
                <textarea name="note" id="note" placeholder="Write Here" class="textarea"><?php echo "$descp" ?></textarea>
            </div>
            <button class='hover' type="submit" name="submit" style=" color: black;background-color:  rgb(248, 248, 156);font-weight:800" onMouseOver="this.style.backgroundColor='#f6f600'" onMouseOut="this.style.backgroundColor='#f8f89c'">SAVE</button>
        </form>

    </main>
    <script>
        CKEDITOR.replace('note');
    </script>

</body>

</html>