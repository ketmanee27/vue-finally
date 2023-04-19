<?php 

include 'db_connect.php';

extract($_POST);

if(empty($id)){
	$data=  " title='".$title."'";
	$data .=  ", qpoints='".$qpoints."'";
	$insert_quiz = $conn->query('INSERT INTO quiz_list set  '.$data);

	if($insert_quiz){
			echo json_encode(array('status'=>1,'id'=>$conn->insert_id));
		
	}
}else{
	$data=  " title='".$title."'";
	$data .=  ", qpoints='".$qpoints."'";
	$update = $conn->query('UPDATE quiz_list set  '.$data.' where id= '.$id);

	if($update){
			echo json_encode(array('status'=>1,'id'=>$id));
		
	}
}