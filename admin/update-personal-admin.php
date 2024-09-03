<?php ob_start();  
include('partials/menuadmin.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Update Personal Information</h2>
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
                    else {
                        echo "Error";
                    }
                    
        ?>

    <form action="" method="POST">
        <table class="tbl-30">
            <tr class="tbl">
                <td >Name: </td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>

            <tr class="tbl">
                <td >Username: </td>
                <td><input type="hidden"><?php echo $username; ?></td>
            </tr>

            <tr class="tbl">
                <td >Phone Number: </td>
                <td><input type="text" name="phone_number" value="<?php echo $phone; ?>"></td>
            </tr>

            <tr class="tbl">
                <td>Email: </td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>

            <tr class="tbl">
                <td >Type: </td>
                <td><input type="hidden"><?php echo $type; ?></input></td>
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
        //Check whether the Submit Button is Clicked or not
        if(isset($_POST['submit'])) {
            //echo "Button Clicked";
            //get all the values from form to update
            $id = $_POST['id'];
            $name = $_POST['name'];
            $phone_number = $_POST['phone_number'];
            $emails = $_POST['email'];

            //Create a SQL Query to Update Admin
            $sql1 = "UPDATE user SET
            Name = '$name',
            User_PhoneNum = '$phone_number',
            User_Email = '$emails'
            WHERE User_ID='$id'
            ";

            //Execute the Query
            $res1 = mysqli_query($conn, $sql1);
        
            //Check whether the query executed successfully or not
            if($res1==true) {
                //Query Executed and Admin Updated
                $_SESSION['update'] = "<div class='success'>Personal Information Updated Successfully</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/personal-admin.php');
            }
            else {
                //Failed to Update Admin
                $_SESSION['update'] = "<div class='error'>Failed to Personal Information</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/personal-admin.php');
            }
    }
    else if(isset($_POST['cancel'])) {
        header('location:'.SITEURL.'admin/personal-admin.php');
    }

    ob_end_flush();
?>
