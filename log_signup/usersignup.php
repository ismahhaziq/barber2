<!DOCTYPE html>

<html>
<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
</head>
<body>
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
            <h1>Sign Up</h1>
            <form action="usersignupquery.php" method="POST">
                <?php if (isset($_GET['error'])) { ?>
                <p id="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                    

                    <p>Name</p>
                    <?php if (isset($_GET['name'])) { ?>
                    <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
                    <?php 
                    }
                    else { ?>
                    <input type="text" name="name" placeholder="Name"><br>
                    <?php 
                    } ?>

                    <p>Username</p>
                    <?php if (isset($_GET['username'])) { ?>
                    <input type="text" name="username" placeholder="User Name" value="<?php echo $_GET['username']; ?>"><br>
                    <?php 
                    }
                    else { ?>
                    <input type="text" name="username" placeholder="User Name"><br>
                    <?php 
                    } ?>

                    <p>Email</p>
                    <?php if (isset($_GET['email'])) { ?>
                    <input type="text" name="email" placeholder="Email" value="<?php echo $_GET['email']; ?>"><br>
                    <?php 
                    }
                    else { ?>
                    <input type="text" name="email" placeholder="Email"><br>
                    <?php 
                    } ?>

                    <p>Phone Number</p>
                    <?php if (isset($_GET['phone_number'])) { ?>
                    <input type="text" name="phone_number" placeholder="Phone Number" value="<?php echo $_GET['phone_number']; ?>"><br>
                    <?php 
                    }
                    else { ?>
                    <input type="text" name="phone_number" placeholder="Phone Number"><br>
                    <?php 
                    } ?>
                
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter password" />

                <p>Re-Enter Password</p>
                <input type="password" name="re_password" placeholder="Re enter password" />

                <input type="submit" class="haha" value="Sign Up">

                <a class="oldacc" href="userlogin.php">Already have an account?</a>
            </form>
    </div>
</body>
</html>