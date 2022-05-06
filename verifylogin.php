<?php 
session_start(); 
include "connect.php";

//Check how form was submitted
if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {

	//validates format of submission
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	//variables to validate
	$email = validate($_POST['userEmail']);
	$pass = validate($_POST['userPassword']);

	//ensure submission is not empty
	if (empty($email)) {
		header("Location: login.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		//find row in logininfo table with corresponding email
		$sql = "SELECT * FROM loginInfo WHERE userEmail='$email' AND userPassword='$pass'";

		$result = mysqli_query($conn, $sql);

		//check if all rows match
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['userEmail'] === $email && $row['userPassword'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['userEmail'] = $row['userEmail'];
            	header("Location: index.html");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}