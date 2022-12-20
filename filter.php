<?php
@include 'config/database.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/content.css">
    <title>NOTE IT!</title>
</head>

<body>
    <header class="head">
        <div class='logo'>
            <img class='hd-img' src="./images/579703.png" alt="logo">
            <div>WELCOME <span style="margin-left:1rem;color:yellow"><?php echo  $_SESSION['user_name'] ?></span></div>
        </div>
        <div>
            <form method="POST">
                <input type="text" name="search" id="search" placeholder="Search" style="text-align: center" required>
                <input type="submit" value="Search" name="submit" class="search-btn">
            </form>

        </div>
        <div class="nav">
            <a class='hover ' style=" color: black;background-color:  rgb(248, 248, 156);font-weight:800" onMouseOver="this.style.backgroundColor='#f6f600'" onMouseOut="this.style.backgroundColor='#f8f89c'" href="Logout.php">LOG OUT</a>
        </div>
    </header>
    <h1 class='heading'>YOUR &nbsp;&nbsp;NOTES</h1>
    <?php
    $email = $_SESSION['user_email'];



    if (isset($_POST['submit'])) {
        $titles = $_POST['search'];
        $query = "SELECT * FROM `$email` WHERE title like '%$titles%' ";
        $result = mysqli_query($conn2, $query);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $date = $row['date'];
                $descp = $row['description'];
                $title = $row['title'];
                $sl_no = $row['sl_no'];
                echo "<main class='container'>
            
                <div class='note'>
                    <div class='title'>
                        <p>$date</p>
                    </div>
                    <h3> $title</h3>
                    <div class='crud'>
                        <a href='edit.php?title=$title&id=$sl_no&email=$email'  class='btn edit'>Edit</a>
                        <a href='delete.php?id=$sl_no&email=$email' class='btn delete' >Delete</a>
                    </div>
                </div>
            </main>";
            }
        } else {
            echo "<main class='container'>
            
                <div style='background-color:rgb(248, 248, 156)'>
                    <h1 style='text-align:center'> No Matching Notes Found </h1> 
                </div>
            </main>";
        }
    } else {
        $select = "SELECT * FROM `$email` ";
        $result = mysqli_query($conn2, $select);
        $limit = 5;
        $total_pages = ceil(mysqli_num_rows($result) / $limit);
        $curr_page = 1;
        if (isset($_GET['page'])) {
            $curr_page = $_GET['page'];
        }
        $start = ($curr_page - 1) * $limit;
        $query2 = "SELECT * FROM `$email` ORDER BY sl_no DESC LIMIT $start,$limit";
        $result2 = mysqli_query($conn2, $query2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $date = $row['date'];
                $descp = $row['description'];
                $title = $row['title'];
                $sl_no = $row['sl_no'];
                echo     "<main class='container'>
            
            <div class='note'>
                <div class='title'>
                    <p>$date</p>
                </div>
                <h3> $title</h3>
                <div class='crud'>
                    <a href='edit.php?title=$title&id=$sl_no&email=$email'  class='btn edit'>Edit</a>
                    <a href='delete.php?id=$sl_no&email=$email' class='btn delete' >Delete</a>
                </div>
            </div>
        </main>
        ";
            }
            if ($curr_page == $total_pages) {
                echo "<div class='create'>
                <button  class='btn' id='btn'>
                    <div class='create'>
                        <img src='./images/plus.png' class='plus' alt='plus'>
                        <p>Create A Note</p>
                    </div>
            
                </button>
            </div>";
            }
        } else {
            echo " <div class='create' style='margin:2rem'>
            <button  class='btn' id='btn'>
                <div class='create' >
                    <img src='./images/plus.png' class='plus' alt='plus'>
                    <p >Create A Note</p>
                </div>
    
            </button>
        </div>";
        }
    }

    ?>
    <script>
        document.getElementById("btn").onclick = function() {
            location.href = "notes.php";
        };
    </script>

    <footer class="pagination ">
        <?php
        /*  $select = "SELECT * FROM `$email`";
     $result = mysqli_query($conn2, $select);
     $limit = 5;
     $total_pages = ceil(mysqli_num_rows($result) / $limit); */
        if (!isset($_POST['submit'])) {
            echo "<p> Pages-</p>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a  href='?page=$i'>$i</a>";
            }
        }




        ?>

    </footer>
    <script>

    </script>

</body>

</html>