<?php include('../admin/config/constant.php'); 
?>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

<div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <header>
        <div class="main">
            <div class="logo">
                <img src="../image/haha.png">
            </div>
            <ul>
                <li class="active"><a href="../index/index.html">Home</a></li>
                <li><a href="../index/index.html.#about">About</a></li>
                <li><a href="../index/index.html.#service">Services</a></li>
                <li><a href="../index/index.html.#contact">Contact</a></li>
            </ul>
        </div>
    </header>
    <div class="loginbox">
            <img src="../image/avatar.png" class="avatar">
            <h1>Login</h1>

            <form action="userloginquery.php" method="POST">
                <?php                                 
            
                if (isset($_GET['error'])) { ?>
                <p id="error"><?php echo $_GET['error']; ?></p>
                <?php } 
                                if(isset($_SESSION['no-login-message'])) {
                                    echo $_SESSION['no-login-message'];
                                    unset($_SESSION['no-login-message']);
                                }
                ?>
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Username" />

                <p>Password</p>
                <input type="password" name="password" placeholder="Enter password" />

                <input type="submit" class="haha" value="Log In" />
                <a class="pass" href="usersignup.php">Don't have an account?</a>
            </form>
    </div>
</body>
</html>

<script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
    });
</script>