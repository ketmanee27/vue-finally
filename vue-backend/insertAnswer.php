<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT ');
header("Access-Control-Allow-Headers: Content-Type");


$request = json_decode(file_get_contents("php://input"));

if ($request != null) {
  /**
   * Connect databaseeeeeeeeeeeeeeeeeee
   */
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "project";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  /**
   * Insert question and typeeeeeeeeeeeeeeeeeee
   */
  $question_detail = $request->question_detail;
  $question_type = $request->question_type;
  $lesson_id = $request->lesson_id;

  $sql1 = "INSERT INTO question (question_detail,question_type,lesson_id) VALUES ('$question_detail','$question_type','$lesson_id')";

  if ($conn->query($sql1) === true) {
    // successssssssssssssssssssssssss

    foreach ($request->answerdetail as $a) {
      $answer_detail = $a->answer_detail;
      $answer_status = $a->answer_status;
      $answer_score = $a->answer_score;
      $question_id = $a->$question_id;


      $sql2 = "INSERT INTO answer (answer_detail,answer_status,answer_score) VALUES ('$answer_detail','$answer_status','$answer_score')";

      if ($conn->query($sql2) === true) {
        echo "Success";
      } else {
        var_dump("Error: " . $sql2 . "<br>" . $conn->error);
      }
    }
  } else {
    var_dump("Error: " . $sql1 . "<br>" . $conn->error);
  }

  $conn->close();
}