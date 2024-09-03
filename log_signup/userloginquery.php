<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	$username = validate($_POST['username']);
	$pass = validate($_POST['password']);
	

	if (empty($username)) { //Redirect to login page
		header("Location: userlogin.php?error=Username is required");
		exit();
	}else if(empty($pass)){
        header("Location: userlogin.php?error=Password is required");
		exit();
	}
	else {
		// hashing the password
        $pass = md5($pass); //encrypt password

		$sql = "SELECT * FROM user WHERE User_Name='$username' AND User_Password='$pass'";
		
		$result = mysqli_query($conn, $sql);

	
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['User_Name'] === $username && $row['User_Password'] === $pass) {
				if($row['User_Type'] == "admin") {
					$_SESSION['User_Name'] = $row['User_Name'];
					$_SESSION['User_ID'] = $row['User_ID'];
					$_SESSION['User_Email'] = $row['User_Email'];
					header("Location: ../admin/adminmainpage.php");
					exit();
				}
				else if($row['User_Type'] == "user"){
					$_SESSION['User_Name'] = $row['User_Name'];
					$_SESSION['User_ID'] = $row['User_ID'];
					$_SESSION['User_Email'] = $row['User_Email'];
					header("Location: ../user/usermainpage.php");
					exit();
				}
            }
            else {
				header("Location: userlogin.php?error=Incorrect Username or Password");
				exit();
			}
		}
        else {
			header("Location: userlogin.php?error=Incorrect Username or Password");
			exit();
		}
	}
}
else{
	header("Location: userlogin.php");
	exit();
}