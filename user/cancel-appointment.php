<?php ob_start();  
include('partials/menuuser.php'); ?>

    <div class="admin-content">
        <h3>Are you sure you want to cancel the appointment?</h3>
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
                                    $newDate = date("d/m/Y", strtotime($app_date));
                                    $newTime = date('h:i A', strtotime($app_time));
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
                        <?php 
                            //Create PHP Code to display categories from database
                            //1. Create SQL to get all active categories from database

                            $sql = "SELECT * FROM appointment a, services s WHERE App_ID = '$app_id' AND a.Service_ID = s.Service_ID AND User_ID = '$user_id'";

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
                                    <input type="hidden" value="<?php echo $service_id; ?>"><?php echo $service_name."(RM".$price.")"; ?></input>
                                    <?php
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>

                <tr class="tbl">
                    <td >Date: </td>
                    <td><input type="hidden" name="date" value=""><?php echo $newDate; ?></td>
                </tr>

                <tr class="tbl">
                    <td >Time: </td>
                    <td><input type="hidden" name="time" value=""><?php echo $newTime; ?></td>
                </tr>

                <tr class="tbl">
                    <td colspan="2">
                        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                        <a href="<?php echo SITEURL; ?>user/add-comment.php?id=<?php echo $app_id; ?>" class="btn-secondary">Yes
                        <a href="<?php echo SITEURL; ?>user/manageappointment_user.php?id=<?php echo $app_id; ?>" class="btn-danger">No
                    </td>
                </tr>
            </table>
          </form>
    </div>
</body>
</html>

<?php 
    ob_end_flush();
?>
