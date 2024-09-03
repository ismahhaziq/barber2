<?php include('../admin/config/constant.php');

    $user_id = $_SESSION['User_ID'];
?>

<div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                            <?php 
                                //Query to get all category data
                                $sql ="SELECT * FROM appointment WHERE App_Status ='Pending' AND User_ID = '$user_id'";
                                //Execute the Query
                                $res = mysqli_query($conn,$sql);

                                //Check whether the Query is executed or not
                                if($res==true) {
                                    //Count rows to check whether we have data in the database
                                    $count = mysqli_num_rows($res); //Func to get all the rows in database
                                }

                                //Query to get all category data
                                $sql1 ="SELECT * FROM appointment WHERE (App_Status ='Approved' AND User_ID = '$user_id')";
                                //Execute the Query
                                $res1 = mysqli_query($conn,$sql1);

                                //Check whether the Query is executed or not
                                if($res1==true) {
                                    //Count rows to check whether we have data in the database
                                    $count1 = mysqli_num_rows($res1); //Func to get all the rows in database
                                }
                                //Query to get all category data
                                $sql2 ="SELECT * FROM appointment WHERE App_Status ='Rejected' AND User_ID = '$user_id'";
                                //Execute the Query
                                $res2 = mysqli_query($conn,$sql2);

                                //Check whether the Query is executed or not
                                if($res2==true) {
                                    //Count rows to check whether we have data in the database
                                    $count2 = mysqli_num_rows($res2); //Func to get all the rows in database
                                }

                                //Query to get all category data
                                $sql4 ="SELECT * FROM appointment WHERE App_Status ='Cancel' AND User_ID = '$user_id'";
                                //Execute the Query
                                $res4 = mysqli_query($conn,$sql4);

                                //Check whether the Query is executed or not
                                if($res4==true) {
                                    //Count rows to check whether we have data in the database
                                    $count4 = mysqli_num_rows($res4); //Func to get all the rows in database
                                }
                            ?>
                                <span>Total Appointment(Ongoing)</span>  
                            </div>
                            <div class="card-chart success">
                                <small class="process">Pending</small>
                                <h2><?php echo $count; ?></h2>
                                <small class="error">Rejected</small>
                                <h2><?php echo $count2; ?></h2>
                                <small class="cancel">Cancel</small>
                                <h2><?php echo $count4; ?></h2>
                                <small>Approved</small>
                                <h2><?php echo $count1; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                            <?php 
                                //Query to get all category data
                                $sql2 ="SELECT * FROM appointment WHERE (App_Status='RejectedData' AND User_ID = '$user_id') OR (App_Status='Historyreject' AND User_ID = '$user_id')";
                                //Execute the Query
                                $res2 = mysqli_query($conn,$sql2);

                                //Check whether the Query is executed or not
                                if($res2==true) {
                                    //Count rows to check whether we have data in the database
                                    $count2 = mysqli_num_rows($res2); //Func to get all the rows in database
                                }
                                //Query to get all category data
                                $sql3 ="SELECT * FROM appointment WHERE (App_Status ='Done' AND User_ID = '$user_id') OR (App_Status='ApprovedData' AND User_ID = '$user_id') OR (App_Status='Historydone' AND User_ID = '$user_id')";
                                //Execute the Query
                                $res3 = mysqli_query($conn,$sql3);

                                //Check whether the Query is executed or not
                                if($res3==true) {
                                    //Count rows to check whether we have data in the database
                                    $count3 = mysqli_num_rows($res3); //Func to get all the rows in database
                                }

                                //Query to get all category data
                                $sql4 ="SELECT * FROM appointment WHERE (App_Status='Historycancel' AND User_ID = '$user_id') OR (App_Status='CancelData' AND User_ID = '$user_id')";
                                //Execute the Query
                                $res4 = mysqli_query($conn,$sql4);

                                //Check whether the Query is executed or not
                                if($res4==true) {
                                    //Count rows to check whether we have data in the database
                                    $count4 = mysqli_num_rows($res4); //Func to get all the rows in database
                                }
                            ?>
                                <span>Total Appointment</span>  
                            </div>
                            <div class="card-chart success">
                                <small class="error">Rejected</small>
                                <h2><?php echo $count2; ?></h2>
                                <small class="cancel">Cancel</small>
                                <h2><?php echo $count4; ?></h2>
                                <small class="done">Done</small>
                                <h2><?php echo $count3; ?></h2>
                            </div>
                        </div>
                    </div>