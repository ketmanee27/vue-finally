<?php
include "connectDB.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT ');
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"));

$request = $data->request;

// Fetch All records โชว์
if($request == 1){
	$userData = mysqli_query($con,"SELECT * FROM login ORDER BY id DESC");
    // $query = "SELECT * FROM login ORDER BY id DESC";
	$response = array();
	while($row = mysqli_fetch_assoc($userData)){
	    $response[] = $row;
	}

	echo json_encode($response);
	exit;
}

// Add record เพิ่ม
if($request == 2){
	$name = $data->name;
	$email = $data->email;

	$userData = mysqli_query($con,"SELECT * FROM login WHERE name='".$name."'");
	if(mysqli_num_rows($userData) == 0){
		mysqli_query($con,"INSERT INTO login (name, email) VALUES ('".$name."', '".$email."')");
		echo "Add record";
	}else{
		echo "Username already exists.";
	}

	exit;
}

// Update record แก้ไข
if($request == 3){
	$id = $data->id;
	$name = $data->name;
	$email = $data->email;

	mysqli_query($con,"UPDATE login SET name='".$name."',email='".$email."' WHERE id=".$id);
		 
	echo "Update record";
	exit;
}

// Delete record ลบ
if($request == 4){
	$id = $data->id;

	mysqli_query($con,"DELETE FROM login WHERE id=".$id);

	echo "Delete successfully";
	exit;
}
?>