<?php 

    //Include constant.php file here
    include('config/constant.php');

    // 1. Get the ID of Services to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to delete admin
    $sql = "UPDATE appointment SET App_Status = 'Done' WHERE App_ID = $id";

    //Execute the Query
    $res = mysqli_query($conn, $sql) or die("error".mysqli_error($conn));
    
    //Check whether the query executed successfully or not
    if($res==true) {
        //Query Executed Successfully and Service Deleted
        //echo "Admin Deleted"; --> to check 
        //Create Session Variable to Display Message
        $_SESSION['done'] = "<div class='success'>Appointment Completed</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/approvedpage.php');
    }
    else {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";
        $_SESSION['done'] = "<div class='error'>Failed to Completing Appointment</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/approvedpage.php');
    }

    // 3. Redirect tp Manage Service Page with message (success/error)
?> 