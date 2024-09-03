<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) 
	&& isset($_POST['email']) && isset($_POST['re_password']) && isset($_POST['phone_number'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$name = validate($_POST['name']);
	$username = validate($_POST['username']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$email = validate($_POST['email']);
	$phone_number = validate($_POST['phone_number']);

	$user_data = 'username='. $username;

	if (empty($name)) {
		header("Location: usersignup.php?error=Name is required&$user_data");
	    exit();
	}
	if (empty($username)) {
		header("Location: usersignup.php?error=User Name is required&$user_data");
	    exit();
	}
	else if(empty($pass)){
        header("Location: usersignup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: usersignup.php?error=Re Password is required&$user_data");
	    exit();
	}
	else if(empty($email)){
        header("Location: usersignup.php?error=Email is required&$user_data");
	    exit();
	}
	else if(empty($phone_number)){
        header("Location: usersignup.php?error=Phone number is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: usersignup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM user WHERE User_Name='$username' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: usersignup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO user(Name,User_Name, User_Password, User_Email, User_PhoneNum, User_Type) VALUES('$name','$username', '$pass', '$email', '$phone_number', 'user')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: usersignup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: usersignup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: usersignup.php");
	exit();
}