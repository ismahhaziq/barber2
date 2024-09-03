<?php ob_start();  
include('partials/menuadmin.php'); ?>

    <div class="admin-content">
        <h2 class="page-title">Add Service</h2>
        <?php       
            $id = $_SESSION['User_ID'];
            
            if(isset($_SESSION['add'])) { //Checkin whether the Session is Set of Not
                echo $_SESSION['add']; //Displaying Session Message
                unset($_SESSION['add']); //Removing Session Message
            }    
        ?>

    <form action="" method="POST">

    <table class="tbl-30">
        <tr class="tbl">
            <td >Service Name: </td>
            <td><input type="text" name="service_name" placeholder="Enter service name"></td>
        </tr>

        <tr class="tbl">
            <td >Minutes: </td>
            <td><input type="text" name="minutes" placeholder="Enter minutes"></td>
        </tr>

        <tr>
            <td>Price: </td>
            <td>
                <input type="number" name="price" placeholder="Enter price">
            </td>
        </tr>

        <tr>
            <td>Available: </td>
            <td>
                <input type="radio" name="available" value="Yes"> Yes
                <input type="radio" name="available" value="No"> No
            </td>
        </tr>

        <tr class="tbl">
            <td colspan="2">
                <input type="submit" name="submit" value="Add Service" class="btn-secondary">
                <input type="submit" name="cancel" value="Cancel" class="btn-danger">
            </td>
        </tr>
    </table>
    </form>
    </div>
</body>
</html>

<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit'])) {
        //Button Clicked
        //echo "Button Clicked";

        //1. Get the DATA from Form
        $service_name = $_POST['service_name'];
        $minutes = $_POST['minutes'];
        $price = $_POST['price'];

        //For radio input, we need to check whether the button is selected or not
        if(isset($_POST['available'])) {
            //Get the value from form
            $available = $_POST['available'];
        }
        else {
            //Set the Default Value
            $available = "No";
        }

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO services SET
            Service_Name = '$service_name',
            Minutes = '$minutes',
            Available = '$available',
            Service_Price = '$price'
        ";

        //3. Executing Query and Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Service Added Successfully</div>";
            //Redirect Page to Manage Admin
            header('location:'.SITEURL.'admin/manageservice_admin.php');
        }
        else {
            //Failed to Insert Data
            //echo "Failed to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Failed to Add Service</div>";
            //Redirect Page to Add Admin
            header('location:'.SITEURL.'admin/manageservice_admin.php');
        }
    }
    else if(isset($_POST['cancel'])) {
        header('location:'.SITEURL.'admin/manageservice_admin.php');
    }

    ob_end_flush();
?> 
