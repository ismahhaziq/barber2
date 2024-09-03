<?php include('partials/menuadmin.php');

?>

    <div class="admin-content">
        <h2 class="page-title">Pending Appointment</h2>

        <table id="refresh">
        <thead>
                <th>Number</th>
                <th>Name</th>
                <th>Services</th>
                <th>Date</th>
                <th>Time</th>
                <th colspan="3">Action</th>
            </thead>
            <tbody>
            <?php
                    if(isset($_SESSION['approve'])) {
                        echo $_SESSION['approve'];
                        unset($_SESSION['approve']);
                    }
                    if(isset($_SESSION['rejected'])) {
                        echo $_SESSION['rejected'];
                        unset($_SESSION['rejected']);
                    }

                            //Query to get all category data
                            $sql ="SELECT * FROM appointment a, services s, user u WHERE App_Status = 'Pending' AND s.Service_ID = a.Service_ID AND u.User_ID = a.User_ID ORDER BY App_Date ASC, App_Time ASC ";
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
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/approve_appointment.php?id=<?php echo $id; ?>" class="approve">Approve </a> 
                                                <a href="<?php echo SITEURL; ?>admin/reject_appointment.php?id=<?php echo $id; ?>" class="reject">Reject </a>
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
                                        <td colspan="6"><div class="error">No Pending Appointment Yet</div></td>
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
/*     $(document).ready(function(){
		 $("#refresh").load("load.php");
        setInterval(function() {
            $("#refresh").load("load.php");
        }, 1000); 
    });  */

    $(document).ready(function(){
    setInterval(function() {
        $("#refresh").load("loadpendingappointment.php");
    }, 1000);  //wajib buat paling kurang satu saat, kalau dak tak jalan button nanti. Jangan buat bawah satu saat, gelong.
}); 
        
  /*      function refresh()
        {
            setTimeout(function() {
                $('#refresh').fadeOut('slow').load('pendingappointmentload.php').fadeIn('slow');
                refresh();
                }, 100);
        }  */

/* $(document).ready(function(){
setInterval(function(){
      $("#refresh").load(window.location.href + " #refresh" );
}, 1000);
}); */

/* $(document).ready(function(){
setInterval(function(){
    $("#refresh").load(" #refresh > *");
}, 1000);
}); */



/*    $(document).ready(function() {
        $("#refresh").load("load.php");
    var auto_refresh = setInterval( 
        function() { 
        $("#refresh").load("load.php"); 
    }, 1000); // refreshing after every 15000 milliseconds
    }); */
</script>