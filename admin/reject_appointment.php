<?php /*

    //Include constant.php file here
    include('config/constant.php');

    // 1. Get the ID of Services to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to delete admin
    $sql = "UPDATE appointment SET App_Status = 'Rejected' WHERE App_ID = $id";

    //Execute the Query
    $res = mysqli_query($conn, $sql) or die("error".mysqli_error($conn));
    
    //Check whether the query executed successfully or not
    if($res==true) {
        //Query Executed Successfully and Service Deleted
        //echo "Admin Deleted"; --> to check 
        //Create Session Variable to Display Message
        $_SESSION['rejected'] = "<div class='success'>Appointment Rejected</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/pendingpage.php');
    }
    else {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";
        $_SESSION['rejected'] = "<div class='error'>Failed to Reject Appointment</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/pendingpage.php');
    } */

    // 3. Redirect tp Manage Service Page with message (success/error)
?> 

<?php ob_start();  
include('partials/menuadmin.php'); ?>

    <div class="admin-content">
        <h3>Give them reason why you cancel the apppointment.</h3>
        <?php       

                            $app_id = $_GET['id'];
                            
                        //Query to get all category data
                        $sql2 ="SELECT * FROM appointment a, user u WHERE a.App_ID = '$app_id' AND u.User_ID=a.User_ID";
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

                            $sql = "SELECT * FROM appointment a, services s WHERE App_ID = '$app_id' AND a.Service_ID = s.Service_ID";

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
                    <td >Comment: </td>
                    <td>
                        <select name="comment">
                                <option type="radio">Appointment is full</option>
                                <option type="radio">Busy</option>
                        </select>
                    </td>
                </tr>


                <tr class="tbl">
                    <td colspan="2">
                        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                        <input type="submit" name="submit" value="Proceed" class="btn-secondary">
                        <input type="submit" name="cancel" value="Cancel" class="btn-danger">
                    </td>
                </tr>
            </table>
          </form>
    </div>
</body>
</html>

<?php 
if(isset($_POST['submit'])) {
    //Button Clicked
    //echo "Button Clicked";

    //1. Get the DATA from Form
    $comment = $_POST['comment'];

    //echo $service_id;
    //echo $date;
    //echo $time;
    //2. SQL Query to Save the data into database


    $sql2 = "UPDATE appointment SET
        App_Status = 'Rejected',
        Comment = '$comment'
        WHERE App_ID = '$app_id'
    ";
    
    //3. Executing Query and Saving Data into Database
    $res2 = mysqli_query($conn, $sql2) or die("error".mysqli_error($conn));

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res2==true){
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['rejected'] = "<div class='success'>Appointment Rejected</div>";
        //Redirect Page to Manage Admin
        header('location:'.SITEURL.'admin/pendingpage.php');
    }
    
    else {
        //Failed to Insert Data
        //echo "Failed to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['rejected'] = "<div class='error'>Failed to Reject Appointment</div>";
        //Redirect Page to Add Admin
        header('location:'.SITEURL.'admin/pendingpage.php'); 
    } 

}
else if(isset($_POST['cancel'])) {
    header('location:'.SITEURL.'admin/pendingpage.php');
}
    ob_end_flush();
?>
