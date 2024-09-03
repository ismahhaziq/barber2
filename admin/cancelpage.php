<?php include('partials/menuadmin.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Cancelled Appointment</h2>

        <table id="refresh">
            <thead>
                <th>Number</th>
                <th>Name</th>
                <th>Services</th>
                <th>Date</th>
                <th>Time</th>
                <th colspan="2">Comment</th>
                <th colspan="2">Action</th>
            </thead>

            <tbody>
            <?php 
                if(isset($_SESSION['cancel'])) {
                    echo $_SESSION['cancel'];
                    unset($_SESSION['cancel']);
                }

                        //Query to get all category data
                        $sql ="SELECT * FROM appointment a, services s, user u WHERE App_Status = 'Cancel' AND s.Service_ID = a.Service_ID AND u.User_ID = a.User_ID ORDER BY App_Date ASC, App_Time ASC";
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
                                    $id=$rows['App_ID'];
                                    $service=$rows['Service_Name'];
                                    $date=$rows['App_Date'];
                                    $time=$rows['App_Time'];
                                    $name=$rows['Name'];
                                    $user_id=$rows['User_ID'];
                                    $comment = $rows['Comment'];

                                    $newDate = date("d/m/Y", strtotime($date));
                                    $newTime = date('h:i A', strtotime($time));

                                    //Display the values in out table
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $name?></td>
                                        <td><?php echo $service ?></td>
                                        <td><?php echo $newDate ?></td>
                                        <td><?php echo $newTime ?></td>
                                        <td colspan="2"><?php echo $comment?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/noncancel-appointment.php?id=<?php echo $id; ?>" class="approve">Okay</a> 
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else {
                                //We do not have data in database
                                //We'll display the message inside table
                                ?>
                                <tr>
                                    <td colspan="6"><div class="error">No Cancel Appointment</div></td>
                                </tr> 

                                <?php
                            }
                        }
                        ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<script>
        $(document).ready(function(){
    setInterval(function() {
        $("#refresh").load("loadcancelappointment.php");
    }, 1000); //wajib buat paling kurang satu saat, kalau dak tak jalan button nanti. Jangan buat bawah satu saat, gelong.
}); 
</script>