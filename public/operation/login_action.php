<?php
include_once('../includes/db.php');

if(isset($_POST['user_id']) && isset($_POST['password'])){
	$user_id = $_POST['user_id'];
	$user_id = mysqli_real_escape_string($conn, $user_id);
	$password = $_POST['password'];
	$password = mysqli_real_escape_string($conn, $password);
	$sql = "SELECT * FROM users WHERE email = '$user_id' AND password = '$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if($row){

        echo json_encode(['status' => 'success', 'message' => 'You Are Successfully Signed In!']);
	}else{
	    echo json_encode(['status' => 'error', 'message' => 'Failed to Sign In!']);
	}

	
}


?>