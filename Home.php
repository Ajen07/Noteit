<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>NOTE IT</title>
</head>

<body>
    <header class="head">
        <div class='logo'>
            <img class='hd-img' src="./images/579703.png" alt="logo">
            <div>NOTE IT!</div>
        </div>
        <div class="nav">
            <!-- <img src="./images/sun_half.png" alt="theme" class="theme-change" id="darkmode"> -->
            <a class='hover' href="about.php">ABOUT</a>
            <a class='hover' href="help.php">HELP</a>
            <a class='hover' href="Contact.php">CONTACT</a>
            <a class='hover' style=" color: black;background-color:  rgb(248, 248, 156);font-weight:800" onMouseOver="this.style.backgroundColor='#f6f600'" onMouseOut="this.style.backgroundColor='#f8f89c'" href="Login.php">LOGIN</a>
        </div>
    </header>
    <main class="main">
        <div class="hero-sec">
            <p class="content">&quot;&nbsp;Capture important ideas and information in ways that help you stay productive.&quot;&nbsp;</p>
            <a class="hover signup" href="Signup.php">Sign Up For Free</a>
        </div>
        <img class="hero-img" src="./images/hero.png" alt="notes">


    </main>
    <script>
        /* const theme=document.getElementById('darkmode');
        theme.addEventListener('click',change);

        const change=()=>{
            if (document.body.style.backgroundColor='rgb(245, 245, 207)') {
                document.body.style.backgroundColor='white';
                document.querySelector('.head').style.backgroundColor='rgb(245, 245, 207)';
            }
        } */
    </script>

</body>

</html>