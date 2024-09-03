<?php ob_start();  
include('partials/menuadmin.php'); ?>

<div class="admin-content">
        <h2 class="page-title">Update Service</h2>

        <?php 
            //1. Get the ID of Selected Service
                $id=$_GET['id']; //ambil dari form, bukan dari sql database
            

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM services WHERE Service_ID = $id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not'
            if($res==true) {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1){
                    //Get the details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $service_name = $row['Service_Name'];
                    $minutes = $row['Minutes'];
                    $available = $row['Available'];
                    $price = $row['Service_Price'];
                }
                else {
                    //Redirect to Manage Service Page with Session Message
                    $_SESSION['no-service-found'] = "<div class='error'>Service Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr class="tbl">
                    <td>Service Name: </td>
                    <td>
                        <input type="text" name="service_name" value="<?php echo $service_name; ?>">
                    </td>
                </tr>

                <tr class="tbl">
                    <td>Minutes: </td>
                    <td>
                        <input type="text" name="minutes" value="<?php echo $minutes;?>">
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Available: </td>
                    <td>
                        <input <?php  if($available=="Yes"){echo "checked";}?> type="radio" name="available" value="Yes"> Yes
                        <input <?php  if($available=="No"){echo "checked";}?> type="radio" name="available" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Service" class="btn-secondary">
                        <input type="submit" name="cancel" value="Cancel" class="btn-danger">
                    </td>
                </tr>

            </table>
        </form>
</div>

<?php 
        //Check whether the Submit Button is Clicked or not
        if(isset($_POST['submit'])) {
            //echo "Button Clicked";
            //get all the values from form to update
            $id = $_POST['id'];
            $service_name = $_POST['service_name'];
            $minutes = $_POST['minutes'];
            $available = $_POST['available'];
            $newprice = $_POST['price'];

            //Create a SQL Query to Update Admin
            $sql = "UPDATE services SET
            Service_Name = '$service_name',
            Minutes = '$minutes',
            Available = '$available',
            Service_Price = '$newprice'
            WHERE Service_ID='$id'
            ";

            //Execute the Query
            $res = mysqli_query($conn, $sql);
        
            //Check whether the query executed successfully or not
            if($res==true) {
                //Query Executed and Admin Updated
                $_SESSION['update'] = "<div class='success'>Service Updated Successfully</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manageservice_admin.php');
            }
            else {
                //Failed to Update Admin
                $_SESSION['update'] = "<div class='error'>Failed to Update Service</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manageservice_admin.php');
            }
    }
    else if(isset($_POST['cancel'])) {
        header('location:'.SITEURL.'admin/manageservice_admin.php');
    }
    ob_end_flush();
?>