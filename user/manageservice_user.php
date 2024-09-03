<?php include('partials/menuuser.php'); ?>

        <div class="admin-content">
            <h2 class="page-title"> Services Available</h2>

            <table>
                <thead>
                    <th>Number</th>
                    <th>Service Name</th>
                    <th>Estimated Time</th>
                    <th>Price</th>
                    <th>Available</th>
                </thead>

                <tbody>
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
            </tbody>
            </table>
        </div>
</body>
</html>