<?php ob_start();  
include('partials/menuuser.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Change Password</h2>
        <?php       
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
                                    $username=$rows['User_Name'];
                                    $phone=$rows['User_PhoneNum'];
                                    $email=$rows['User_Email'];
                                    $pass=$rows['User_Password'];
                                    $type=$rows['User_Type'];

                                    //Display the values in out table
                                }
                            }
                    }
                    else {
                        echo "Error";
                    }
                    
        ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr class="tbl">
                <td >Current Password: </td>
                <td><input type="password" name="current_password" placeholder="Old Password"></td>
            </tr>

            <tr class="tbl">
                <td >New Password: </td>
                <td><input type="password" name="new_password" placeholder="New Password"></td>
            </tr>

            <tr class="tbl">
                <td>Confirm Password: </td>
                <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
            </tr>

            <tr class="tbl">
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Save" class="btn-secondary">
                    <input type="submit" name="cancel" value="Cancel" class="btn-danger">
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>
<?php 
    //Check whether the Submit Button  is Clicked or not
    if(isset($_POST['submit'])) {
        //echo "Button Clicked";

        //1. Get the Data from Form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']); //remember, md5 is use for encryption
        $new_password = md5($_POST['new_password']);
        $confirm_pasword = md5($_POST['confirm_password']);

        //2. Check whether the user with current ID and Current Password Exist or Not
        $sql = "SELECT * FROM user WHERE User_ID=$id AND User_Password='$current_password'";

        //Execute the Query
        $res = mysqli_query($conn,$sql);

        if($res==true) {
            //Check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1) {
                //user exist and Password can be changed
                //echo "User Found";

                //Check whether the new password abd confirm match or not
                if($new_password==$confirm_pasword) {
                    //Update the password
                    $sql2 = "UPDATE user SET
                    User_Password='$new_password'
                    WHERE User_ID=$id
                    ";

                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether the query executed or not
                    if($res2==true) {
                        //Display Success Message
                        //Redirect to Manage Admin Page with Success Message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                        //Redirect the user
                        header('location:'.SITEURL.'user/personal-user.php');
                    }
                    else {
                        //Display error message
                        //Redirect to Manage Admin Page with Error Message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password</div>";
                        //Redirect the user
                        header('location:'.SITEURL.'user/personal-user.php');
                    }
                }
                else {
                    //Redirect to Manage admin Page with Error Message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";
                    //Redirect the user
                    header('location:'.SITEURL.'user/personal-user.php');
                }
            }
            else {
                //User does not exist
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                header('location:'.SITEURL.'user/personal-user.php');
            }
        }
        //3. Check whether the New Password and Confirm Password Match or not
    }
    else if(isset($_POST['cancel'])) {
        header('location:'.SITEURL.'user/personal-user.php');
    }
    ob_end_flush();
?>
