<?php
    include('config/constant.php'); 
    include('../log_signup/logincheck.php');
    
    if (isset($_SESSION['User_ID']) && isset($_SESSION['User_Name'])) {
        //Query to get all category data
        $user_name = $_SESSION['User_Name'];
        $sql ="SELECT * FROM user WHERE User_Name = '$user_name'";
        //Execute the Query
        $res = mysqli_query($conn,$sql);

        //Check whether the Query is executed or not
        if($res==true) {
            //Count rows to check whether we have data in the database
            $count = mysqli_num_rows($res); //Func to get all the rows in database
            

            //Check the num of rows
            if($count>0) {
                //We have data in database
                while($rows=mysqli_fetch_assoc($res)) {
                    //using while loop to get all the data from database
                    //and While loop will run as long as we have data in database

                    //Get individual data
                    $name=$rows['Name'];
                }
            }
        }
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Admin Page</title>
    <link rel="stylesheet" href="../css/admincss.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/4.1.0/introjs.min.css"/>
    <link href="../css/modern.css" rel="stylesheet">
</head>
<body>
    <input type="checkbox" name="" id="sidebar-toggle" />

    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="../image/avatar.png" width="40px" alt="" />

                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>

        <div class="sidebar-main">
            <div class="sidebar-user">
                <img src="../image/profile.png">
                <div>
                    <h3><?php echo $name; ?></h3>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="menu-head">
                    <span>Dashboard</span>
                </div>
                <ul>
                    <li >
                        <a href="../admin/adminmainpage.php">
                            <span class="las la-chart-pie"></span>
                            Analytics
                        </a>
                    </li>
                    
                    <li class="sub-btn">
                        <a>
                            <span class="las la-tasks" ></span>
                            Management
                        </a>
                        <ul>
                            <div class="sub-menu">
                                <li class="manage-btn"><a >Manage Appointment</a></li>
                                    <ul class="sub-menu2">
                                        <li><a href="../admin/pendingpage.php">Pending</a></li>
                                        <li><a href="../admin/approvedpage.php">Approved</a></li>
                                        <li><a href="../admin/cancelpage.php">Cancel</a></li>
                                    </ul>
                            </div>
                            <li><a href="../admin/manageservice_admin.php">Manage Service</a></li>
                            <li><a href="../admin/manageuser_admin.php">View User</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="../admin/personal-admin.php">
                            <span class="las la-user-edit"></span>
                            Personal Information
                        </a>
                    </li>
                </ul>

                <div class="menu-head">
                    <span>Applications</span>
                </div>
                <ul>
                    <li>
                        <a href="../log_signup/userlogoutquery.php">
                            <span class="las la-sign-out-alt"></span>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="sidebar-toggle">
                    <span class="las la-bars"></span>
                </label>
            </div>

            <div class="header-icons">
                <span class="las la-search"></span>
                <span class="las la-bookmark"></span>
                <span class="las la-sms"></span>
            </div>
        </header>
<?php 
}

else{
     
     header("Location: ../log_signup/userlogin.php");
     exit();
}
?>
<script>

    $(document).ready(function(){
        $('.sub-btn').click(function(){
            $(this).next('.sub-menu').slideToggle();
        });
    });

    
        $(window).on("load",function(){
            setInterval(function() {
                $(".loader-wrapper").fadeOut("slow");
            }, 200);
    });
</script>

