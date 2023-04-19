<?php

@session_start();
        // Create connection
        $connect = new PDO("mysql:host=localhost;dbname=project", "root", "");
        $request = json_decode(file_get_contents("php://input"));
        $data = array();
        // Check connection
        // if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        // }
// if ($request->action == 'fetchall') {
		$id=$_REQUEST['id'];
        $query = "SELECT * FROM lesson where lesson_id='$id'";

        $show = $connect->prepare($query);
        $show->execute();
        // if{
            
        // } else {
        // var_dump("Error: " . $sql . "<br>" . $conn->error);
        // }

        while($row = $show->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        header("Access-Control-Allow-Origin: *");
        header("content-type: application/json");
        echo json_encode($data);
// }
        //$response[] = array('status'=>1);

        //  echo json_encode($response);
    // }
    
?>