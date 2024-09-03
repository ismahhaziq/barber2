<?php 

    //Include constant.php file here
    include('../admin/config/constant.php');

    // 1. Get the ID of Appointment to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to delete admin
    $sql = "UPDATE appointment SET App_Status='Historydone' WHERE App_ID=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);
    
    //Check whether the query executed successfully or not
    if($res==true) {
        //Query Executed Successfully and Service Deleted
        //echo "Admin Deleted"; --> to check '
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Appointment History Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'user/historypage.php');
    }
    else {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Appointment History. Try Again.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'user/historypage.php');
    }

    // 3. Redirect tp Manage Service Page with message (success/error)



?>