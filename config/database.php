<?php

$conn=mysqli_connect('localhost','root','','users');

if ($conn->connect_error) {
    die('Connection Failed' . $conn->connect_error);
}
$conn2=mysqli_connect('localhost','root','','notes');

if ($conn2->connect_error) {
    die('Connection Failed' . $conn->connect_error);
}


?>