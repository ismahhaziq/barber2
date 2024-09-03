<?php include('../admin/config/constant.php');

            $users_id = $_SESSION['User_ID'];
            $user_name = $_SESSION['User_Name'];
            $sql ="SELECT * FROM user u WHERE  User_ID = $users_id";
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
            echo $sql;
            echo "Error";
        }
        ?>
        
        <thead>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Services</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Comment</th>
                    <th colspan="2">Action</th>
                </thead>
                
                <tbody>
                <?php 
                        
                        //Query to get all category data
                        //$sql ="SELECT * FROM appointment a, services s WHERE a.Service_ID = s.Service_ID AND a.User_ID = $users_id ORDER BY (CASE App_Status WHEN 'Pending' THEN 1 WHEN 'Approved' THEN 2 WHEN 'Done' THEN 4 WHEN 'Rejected' THEN 3 END) ASC";
                        $sql ="SELECT * FROM appointment a, services s WHERE a.Service_ID = s.Service_ID AND a.User_ID = $users_id AND (App_Status = 'Pending' OR App_Status = 'Rejected' OR App_Status = 'Approved'OR App_Status = 'Done' OR App_Status = 'Cancel' ) ORDER BY App_Date ASC, App_Time ASC";
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
                                    $app_id=$rows['App_ID'];
                                    $service=$rows['Service_Name'];
                                    $date=$rows['App_Date'];
                                    $time=$rows['App_Time'];
                                    $status=$rows['App_Status'];
                                    $price = $rows['Service_Price'];
                                    $comment = $rows['Comment'];

                                    $newDate = date("d/m/Y", strtotime($date));
                                    $newTime = date('h:i A', strtotime($time));

                                    //Display the values in out table
                                    if($status=="Pending"){
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $service ?></td>
                                        <td><?php echo $newDate ?></td>
                                        <td><?php echo $newTime ?></td>
                                        <td class="process"><?php echo $status ?></td>
                                        <td></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>user/update-appointment.php?id=<?php echo $app_id; ?>" class="approve">Update </a> 
                                            <a href="<?php echo SITEURL; ?>user/delete-appointment.php?id=<?php echo $app_id; ?>" class="reject">Delete </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    if($status=="Rejected") {
                                        ?>
                                        <tr id="message" >
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="error">Rejected</td>
                                            <td class="cancel"><?php echo $comment ?></td>
                                            <td colspan="2">
                                                <a href="<?php echo SITEURL; ?>user/nondelete-appointment.php?id=<?php echo $app_id; ?>" class="reject">Delete </a>
                                            </td>
                                        <tr>
                                        <?php  
                                    }
                                    if($status=="Approved") {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="success">Approved</td>
                                            <td></td>
                                            <td colspan="2">
                                                <a href="<?php echo SITEURL; ?>user/update-appointment.php?id=<?php echo $app_id; ?>" class="approve">Update </a> 
                                                <a href="<?php echo SITEURL; ?>user/cancel-appointment.php?id=<?php echo $app_id; ?>" class="cancel">Cancel</a>
                                            </td>
                                            <tr>
                                        <?php  
                                    }
                                    if($status=="Done") {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="done">Appointment Completed</td>
                                            <td></td>
                                            <td colspan="2">
                                                <a href="<?php echo SITEURL; ?>user/nonapproved-appointment.php?id=<?php echo $app_id; ?>" class="success">Done </a>
                                            </td>
                                            <tr>
                                        <?php  
                                    }
                                    if($status=="Cancel") {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="cancel">Cancel</td>
                                            <td><?php echo $comment ?></td>
                                            <tr>
                                        <?php  
                                    }
                                }
                            }
                            else {
                                //We do not have data in database
                                //We'll display the message inside table
                                ?>
                                <tr>
                                    <td colspan="6"><div class="error">No Appointment Added</div></td>
                                </tr> 
                                <?php
                            }
                        }
                        ?>
                </tbody>
