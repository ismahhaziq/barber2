<?php include('partials/menuadmin.php');
 ?>

        <div class="admin-content">
            <div class="button-group">
                <a href="<?php echo SITEURL; ?>admin/add-service.php" class="btn-big">Add Services</a>
            </div>
            <h2 class="page-title">Manage Services</h2>

            <?php 
                    if(isset($_SESSION['add'])) { //Checkin whether the Session is Set of Not
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }                

                    if(isset($_SESSION['delete'])) { //Checkin whether the Session is Set of Not
                        echo $_SESSION['delete']; //Displaying Session Message
                        unset($_SESSION['delete']); //Removing Session Message
                    }  

                    if(isset($_SESSION['no-service-found'])) {
                        echo $_SESSION['no-service-found'];
                        unset($_SESSION['no-service-found']);
                    }
        
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

            <table>
                <thead>
                    <th>Number</th>
                    <th>Services Name</th>
                    <th>Minutes</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th colspan="3">Action</th>
                </thead>

                <?php 
                        //Query to get all category data
                        $sql ="SELECT * FROM services";
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
                                    $id=$rows['Service_ID'];
                                    $service=$rows['Service_Name'];
                                    $minutes=$rows['Minutes'];
                                    $available=$rows['Available'];
                                    $price=$rows['Service_Price'];

                                    //Display the values in out table
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $service ?></td>
                                        <td><?php echo $minutes ?></td>
                                        <td><?php echo "RM".$price ?></td>
                                        <td><?php echo $available ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-service.php?id=<?php echo $id; ?>" class="approve">Update </a> 
                                            <a href="<?php echo SITEURL; ?>admin/delete-service.php?id=<?php echo $id; ?>" class="reject">Delete </a>
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
                                    <td colspan="6"><div class="error">No Service Added</div></td>
                                </tr> 

                                <?php

                            }
                        }
                        ?>
            </table>
        </div>
</body>
</html>