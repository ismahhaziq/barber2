<?php ob_start();  
include('partials/menuuser.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Update Appointment</h2>
        <?php       
                            $user_id = $_SESSION['User_ID'];
                            $app_id = $_GET['id'];
                            
                        //Query to get all category data
                        $sql2 ="SELECT * FROM appointment a, user u WHERE a.App_ID = '$app_id' AND u.User_ID = '$user_id'";
                        //Execute the Query
                        $res2 = mysqli_query($conn,$sql2);
                        
                        //Check whether the Query is executed or not
                        if($res2==true) {
                            //Count rows to check whether we have data in the database
                            $count2 = mysqli_num_rows($res2); //Func to get all the rows in database

                            //Check the num of rows
                            if($count2>0) {
                                //We have data in database
                                while($rows2=mysqli_fetch_assoc($res2)) {
                                    //using while loop to get all the data from database
                                    //and While loop will run as long as we have data in database

                                    //Get individual data
                                    $app_id=$rows2['App_ID'];
                                    $user_id=$rows2['User_ID'];
                                    $app_date=$rows2['App_Date'];
                                    $app_time=$rows2['App_Time'];
                                    $status=$rows2['App_Status'];
                                    $users_id=$rows2['Name'];

                                    //Display the values in out table
                                }
                            }
                            
                    }
                    else {
                        echo $sql2;
                        echo "Error";
                    }
                    
        ?>

<form action="" method="POST">
            <table class="tbl-30">
                <tr class="tbl">
                    <td >Name: </td>
                    <td><?php echo $users_id; ?></td>
                </tr>

                <tr class="tbl">
                    <td >Services: </td>
                    <td>
                        <select name="service_name">

                        <?php 
                            //Create PHP Code to display categories from database
                            //1. Create SQL to get all active categories from database

                            $sql = "SELECT * FROM services WHERE Available='Yes'";

                            //Executing summary
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we dont have categories
                            if($count>0) {   
                                //We have categories 
                                while($row=mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $service_id = $row['Service_ID'];
                                    $service_name = $row['Service_Name'];
                                    $price = $row['Service_Price'];

                                    ?>          
                                    <option value="<?php echo $service_id; ?>"><?php echo $service_name."(RM".$price.")"; ?></option>
                                    <?php
                                }
                            }
                            else {
                                //We do not have category
                                ?>
                                <option value="0">No Service Found</option>
                                <?php
                            }
                            
                            //2. Display on dropdown
                        ?>
                        </select>
                    </td>
                </tr>

                <tr class="tbl">
                    <td >Date: </td>
                    <td><input type="date" name="date" value="<?php echo $app_date; ?>"></td>
                </tr>

                <tr class="tbl">
                    <td >Time: </td>
                    <td><input type="time" name="time" value="<?php echo $app_time; ?>"></td>
                </tr>

                <tr class="tbl">
                    <td colspan="2">
                        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                        <input type="submit" name="submit" value="Update Appointment" class="btn-secondary">
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
            $service_name = $_POST['service_name'];
            $date = $_POST['date'];
            $time = $_POST['time'];

            //Create a SQL Query to Update Admin
            $sql1 = "UPDATE appointment SET
            App_Date = '$date',
            App_Time = '$time',
            Service_ID = '$service_name',
            App_Status = 'Pending'
            WHERE App_ID = '$app_id' AND User_ID='$user_id'
            ";

            //Execute the Query
            $res1 = mysqli_query($conn, $sql1);
            
            //Check whether the query executed successfully or not
            if($res1==true) {
                //Query Executed and Admin Updated
                $_SESSION['update'] = "<div class='success'>Appointment Updated Successfully</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'user/manageappointment_user.php');
            }
            else {
                //Failed to Update Admin
                $_SESSION['update'] = "<div class='error'>Failed to Update Appointment</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'user/manageappointment_user.php');
            }
        }
    else if(isset($_POST['cancel'])) {
        header('location:'.SITEURL.'user/manageappointment_user.php');
    }

    ob_end_flush();
?>
