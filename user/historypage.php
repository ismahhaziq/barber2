<?php

include('partials/menuuser.php');

 ?>
        <div class="admin-content">
            <h2 class="page-title">History</h2>

            <?php 

            $users_id = $_SESSION['User_ID'];
            $user_name = $_SESSION['User_Name'];
            $sql ="SELECT * FROM user WHERE User_ID = $users_id";
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
                    
                    if(isset($_SESSION['delete'])) { //Checkin whether the Session is Set of Not
                        echo $_SESSION['delete']; //Displaying Session Message
                        unset($_SESSION['delete']); //Removing Session Message
                    } 

                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                
            <table id="refresh">
                <thead>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Services</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Comment</th>
                </thead>

                <?php 
 
                        //Query to get all category data
                        //$sql ="SELECT * FROM appointment a, services s WHERE a.Service_ID = s.Service_ID AND a.User_ID = $users_id ORDER BY (CASE App_Status WHEN 'Rejected' THEN 1 WHEN 'RejectedData' THEN 1 WHEN 'ApprovedData' AND 'Approved' THEN 2 END) ASC";
                        $sql ="SELECT * FROM appointment a, services s WHERE a.Service_ID = s.Service_ID AND a.User_ID = $users_id 
                              AND (App_Status = 'RejectedData' OR App_Status = 'ApprovedData' OR App_Status = 'CancelData') ORDER BY App_Date ASC, App_Time ASC";
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
                                    if($status=="RejectedData") {
                                        ?>
                                        <tr id="message" >
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="error">Rejected</td>
                                            <td class="comment"><?php echo $comment ?></td>
                                        <tr>
                                        <?php  
                                    }
                                    if($status=="ApprovedData") {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="done">Appointment Done</td>
                                            <td></td>
                                        <tr>
                                        <?php  
                                    }
                                    if($status=="CancelData") {
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $service ?></td>
                                            <td><?php echo $newDate ?></td>
                                            <td><?php echo $newTime ?></td>
                                            <td class="cancel">Cancel</td>
                                            <td class="comment"><?php echo $comment ?></td>
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
                                    <td colspan="6"><div class="error">No History</div></td>
                                </tr> 

                                <?php

                            }
                        }
                        ?>
            </table>
        </div>
</body>
</html>

<script>
        $(document).ready(function(){
    setInterval(function() {
        $("#refresh").load("loadhistorypage.php");
    }, 100); //wajib buat paling kurang satu saat, kalau dak tak jalan button nanti. Jangan buat bawah satu saat, gelong.
}); 
</script>

