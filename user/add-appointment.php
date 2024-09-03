<?php ob_start();  
include('partials/menuuser.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Add Appointment</h2>
        <?php       
            $user_id = $_SESSION['User_ID'];
            $sql ="SELECT * FROM user WHERE User_ID = $user_id";
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
                        //Display the values in out table
                    }
                }
        }
        else {
            echo "Error";
        }

            if(isset($_SESSION['add'])) { //Checkin whether the Session is Set of Not
                echo $_SESSION['add']; //Displaying Session Message
                unset($_SESSION['add']); //Removing Session Message
            }  
            
            $app_date = $dr = '';
        ?>

    <form action="" method="POST">
            <table class="tbl-30">
                <tr class="tbl">
                    <td >Name: </td>
                    <td value="<?php echo $user_id; ?>"><?php echo $name; ?></td>
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
                    <td><input type="date" id='date' name="date" value="<?php echo $app_date; ?>"></td>
                </tr>

                <tr class="tbl">
                    <td >Time: </td>
                    <td><input type="time" id='time' name="time" value="<?php echo $app_time; ?>"></td>
                </tr>

                <tr class="tbl">
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Appointment" class="btn-secondary">
                        <input type="submit" name="cancel" value="Cancel" class="btn-danger">
                    </td>
                </tr>
            </table>
          </form>
    </div>
</body>
</html>

<script>
var date = new Date().toISOString().slice(0,10);

//To restrict past date

$('#date').attr('min', date);

mobiscroll.datepicker('#date', {
    controls: ['date'],
    invalid: [
		{
			recurring: {
				repeat: 'weekly',
				weekDays: 'SA,SU'
			}
		}
	]
});

datepicker('#time', {
    controls: ['time'],
    min: '10:30',
    max: '19:30'
});
</script>

<?php 


if(isset($_POST['submit'])) {
    //Button Clicked
    //echo "Button Clicked";

    //1. Get the DATA from Form
    $service_id = $_POST['service_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = "Pending";

    //echo $service_id;
    //echo $date;
    //echo $time;
    //2. SQL Query to Save the data into database


    $sql2 = "INSERT INTO appointment SET
        User_ID = '$user_id',
        Service_ID = '$service_id',
        App_Date = '$date',
        App_Time = '$time',
        App_Status = '$status'
    ";
   
    
    //3. Executing Query and Saving Data into Database
    $res2 = mysqli_query($conn, $sql2) or die("error".mysqli_error($conn));

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res2==true){
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Appointment Added Successfully</div>";
        //Redirect Page to Manage Admin
        header('location:'.SITEURL.'user/manageappointment_user.php');
    }
    
    else {
        //Failed to Insert Data
        //echo "Failed to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add Appointment</div>";
        //Redirect Page to Add Admin
        header('location:'.SITEURL.'user/manageappointment_user.php'); 
    } 
}
else if(isset($_POST['cancel'])) {
    header('location:'.SITEURL.'user/manageappointment_user.php');
}
ob_end_flush();
?> 
