<?php include('partials/menuadmin.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Personal Information</h2>
        <?php       
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
                    if(isset($_SESSION['user-not-found'])) {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match'])) {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])) {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                        if(isset($_SESSION['User_ID'])) {
                            $id = $_SESSION['User_ID'];
                            

                        //Query to get all category data
                        $sql ="SELECT * FROM user WHERE User_ID = $id";
                        //Execute the Query
                        $res = mysqli_query($conn,$sql);

                        //Check whether the Query is executed or not
                        if($res==true) {
                            //Count rows to check whether we have data in the database
                            $count = mysqli_num_rows($res); //Func to get all the rows in database

                            $sn=1; //Create a variable and assign the value

                            //Check the num of rows
                            if($count>0) {
                                //We have data in database
                                while($rows=mysqli_fetch_assoc($res)) {
                                    //using while loop to get all the data from database
                                    //and While loop will run as long as we have data in database

                                    //Get individual data
                                    $id=$rows['User_ID'];
                                    $name=$rows['Name'];
                                    $username=$rows['User_Name'];
                                    $phone=$rows['User_PhoneNum'];
                                    $email=$rows['User_Email'];
                                    $pass=$rows['User_Password'];
                                    $type=$rows['User_Type'];

                                    //Display the values in out table
                                }
                            }
                        }
                    }
                    else {
                        echo "Error";
                    }
                    
        ?>

    <form action="" method="">
        <table class="tbl-30">
            <tr class="tbl">
                <td >Name: </td>
                <td name="name"><?php echo $name; ?></td>
            </tr>

            <tr class="tbl">
                <td >Username: </td>
                <td name="username"><?php echo $username; ?></td>
            </tr>

            <tr class="tbl">
                <td >Phone Number: </td>
                <td><?php echo $phone; ?></td>
            </tr>

            <tr class="tbl">
                <td>Email: </td>
                <td><?php echo $email; ?></td>
            </tr>

            <tr class="tbl">
                <td >Type: </td>
                <td><input type="hidden"><?php echo $type; ?></input></td>
            </tr>

            <tr class="tbl">
                <td colspan="2">
                    <a href="<?php echo SITEURL; ?>admin/update-personal-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Edit</a>
                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>
