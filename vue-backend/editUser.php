<?php
    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: GET, POST, PUT ');
    // header("Access-Control-Allow-Headers: Content-Type");

    // $request = json_decode(file_get_contents("php://input"));


    // if ($request != null) {
    //     $name = $request->name;
    //     $email = $request->email;

        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "project";

        // $servername = "localhost";
        // $username = "root";
        // $password = "";

        // Create connection
        $connect = new PDO("mysql:host=localhost;dbname=project", "root", "");
        $request = json_decode(file_get_contents("php://input"));
        $data = array();
        // Check connection
        // if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        // }
// if ($request->action == 'fetchall') {
    $query = "SELECT user_id,user_firstname,user_lastname,user_email,user_type,user_birthday,user_age,user_district,user_province,create_at,update_at FROM user ORDER BY user_id DESC" ;

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
        
        
    // }
    
?>