<?php
@include 'config/database.php';
$sl_no = $_GET['id'];
$table = $_GET['email'];
$delete = "DELETE FROM `$table` WHERE sl_no='$sl_no'";
$result = mysqli_query($conn2, $delete);

$query = "SELECT * FROM `$table`";
$result2 = mysqli_query($conn2, $query);
if (mysqli_num_rows($result2) > 0) {

    while ($row = mysqli_fetch_assoc($result2)) {
        if ((int)$row['sl_no'] > (int)$sl_no) {
            $id = ((int)$row['sl_no']) - 1;
            $id_change=(string)$id;
            $title = $row['title'];
            $update = "UPDATE `$table` SET `sl_no`='$id_change' WHERE title='$title'";
            $result3 = mysqli_query($conn2, $update);
        }
    }
    $query2="SELECT MAX( `sl_no` ) AS max FROM `$table`";
    $result4=mysqli_query($conn2,$query2);
    $row=mysqli_fetch_assoc($result4);
    $largest=$row['max'];
    $query3="ALTER TABLE `$table` AUTO_INCREMENT = $largest";
    $result3=mysqli_query($conn2,$query3);
}


header('Location:content.php');
