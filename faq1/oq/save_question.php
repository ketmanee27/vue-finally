<?php 
include 'db_connect.php';
extract($_POST);

if(empty($id)){
	$last_order = $conn->query("SELECT * FROM questions where qid = $qid order by order_by desc limit 1")->fetch_array()['order_by'];
	$order_by = $last_order > 0 ? $last_order + 1 : 0;
	$data = 'question = "'.$question.'" ';
	$data .= ', order_by = "'.$order_by.'" ';
	$data .= ', qid = "'.$qid.'" ';
	$insert_question = $conn->query("INSERT INTO questions set ".$data);
	if($insert_question){
		$question_id = $conn->insert_id;
		$insert = array();
		for($i = 0 ; $i < 4;$i++){
			$is_right = isset($_POST["is_right"][$i]) ? 1 : 0;
			$option_txt = isset($_POST["question_opt"][$i]) ? $_POST["question_opt"][$i] : '';
			if(!empty($option_txt)){
				$insert[] = $conn->query("INSERT INTO question_opt set question_id = $question_id, option_txt = '".$question_opt[$i]."',`is_right` = $is_right ");
			}
		}
		if(count($insert) == 4){
			echo 1;
		}else{
			$delete = $conn->query("DELETE FROM questions where id =".$question_id);
			$delete2 = $conn->query("DELETE FROM question_opt where question_id =".$question_id);
			echo 2;
		}
	}
}else{
	$data = 'question = "'.$question.'" ';
	$data .= ', qid = "'.$qid.'" ';
	$update = $conn->query("UPDATE questions set ".$data." where id = ".$id);
	if($update){
		$delete= $conn->query("DELETE FROM question_opt where question_id =".$id);
		$insert = array();
		for($i = 0 ; $i < 4;$i++){
			$answer = isset($is_right[$i]) ? 1 : 0;
			$option_txt = isset($_POST["question_opt"][$i]) ? $_POST["question_opt"][$i] : '';
			if(!empty($option_txt)){
				$insert[] = $conn->query("INSERT INTO question_opt set question_id = $id, option_txt = '".$option_txt."',`is_right` = $answer");
			}
		}
		if(count($insert) == 4){
			echo 1;
		}else{
			$delete = $conn->query("DELETE FROM questions where id =".$id);
			$delete2 = $conn->query("DELETE FROM question_opt where question_id =".$id);
			echo 2;
		}
	}
}
?>
