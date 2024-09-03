<?php 

    include('../admin/config/constant.php');
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
    <title>Manage Appointment User</title>
    <link rel="stylesheet" href="../css/usercss.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mobiscroll-jquery@4.0.0/dist/js/mobiscroll.jquery.min.js"></script>
</head>
<body>
    <input type="checkbox" name="" id="sidebar-toggle" />

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
                <img src="../image/profile.png" loading="lazy">
                <div>
                    <h3><?php echo $name; ?></h3>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="menu-head">
                    <span>Dashboard</span>
                </div>
                <ul>
                    <li>
                        <a href="../user/usermainpage.php">
                            <span class="las la-chart-pie"></span>
                            Analytics
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="las la-tasks" class="feat-btn"></span>
                            Management
                        </a>
                            <ul class="feat-show">
                                <li><a href="manageappointment_user.php">Manage Appointment</a></li>
                                <li><a href="manageservice_user.php">View Service</a></li>
                            </ul>
                    </li>
                    <li>
                        <a href="../user/historypage.php">
                            <span class="las la-history"></span>
                            History
                        </a>
                    </li>
                    <li>
                        <a href="../user/personal-user.php">
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