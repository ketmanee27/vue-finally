<?php

session_start();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT ');
    header("Access-Control-Allow-Headers: Content-Type");

    $data = json_decode(file_get_contents("php://input"));
    $request = $data->request;


          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "project";
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
          }

          $query = "SELECT * FROM user WHERE user_email='".$user_email."' AND user_password='".md5($user_password)."'";
          $result = mysqli_query($conn,$query);


          if(mysqli_num_rows($result) == 1){    //mysqli_num_rowsคือการนับแถวถ้าเข้าเงื่อนไขให้เท่ากับ1
            // $response[] = array('status'=>1);

            $row = mysqli_fetch_array($result); //หาแถวที่มีข้อมูลตรงกับที่กรอกข้ามา

            $_SESSION["user_id"] = $row["user_id"];
            // $_SESSION["UserName"] = $row["user_firstname"]." ".$row["user_lastname"];
            $_SESSION["user_type"] = $row["user_type"]; 

            $response[] = array('status'=>1, 'type' => $_SESSION["user_type"], 'id' => $_SESSION["user_id"]);
            

          }else{    
          $response[] = array('status'=>0);
        }
        echo json_encode($response);
        exit;
      
?>