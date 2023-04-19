<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>จัดการแบบทดสอบ</title>
	<link rel="stylesheet" href="css/content.css">
	<?php 
	$qry = $conn->query("SELECT * FROM quiz_list where id = ".$_GET['id'])->fetch_array();

	?>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary"><?php echo $qry['title'] ?></div>
		<button class="btn bt-sm" id="new_question"><i class="fa fa-plus"></i>	เพิ่มคำถาม</button>
		<br>
		<br>
		<div class="card col-md-12" >
			<div class="card-header">
				คำถาม
			</div>
			<div class="card-body">
				<ul class="list-group">
				<?php
					$qry = $conn->query("SELECT * FROM questions where qid = ".$_GET['id']." order by order_by asc");
					while($row=$qry->fetch_array()){
						?>
						<li class="list-group-item"><?php echo $row['question'] ?><br>
							<center>
								 <button class="btn btn-sm edit_question" style="background-color:#56a062 !important;
  color: #fff;" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button class="btn btn-sm remove_question" style="background-color: #ea5859  !important;
  color: #fff;" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
							</center>
						</li>
				<?php
					}
				?>
				</ul>
		</div>
	</div>
	<div class="modal fade" id="manage_question" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">เพิ่มคำถาม</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='question-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>คำถาม:</label>
									<input type="hidden" name="qid" value="<?php echo $_GET['id'] ?>" />
									<input type="hidden" name="id" />
									<textarea rows='3' name="question" required="required" class="form-control" ></textarea>
								</div>
									<label>คำตอบ:</label>

								<div class="form-group">
									<textarea rows="2" name ="question_opt[0]" required="" class="form-control" ></textarea>
									<span>
									<label><input type="radio" name="is_right[0]" class="is_right" value="1"> <small>คำตอบที่ถูกต้อง</small></label>
									</span>
									<br>
									<textarea rows="2" name ="question_opt[1]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[1]" class="is_right" value="1"> <small>คำตอบที่ถูกต้อง</small></label>
									<br>
									<textarea rows="2" name ="question_opt[2]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[2]" class="is_right" value="1"> <small>คำตอบที่ถูกต้อง</small></label>
									<br>
									<textarea rows="2" name ="question_opt[3]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[3]" class="is_right" value="1"> <small>คำตอบที่ถูกต้อง</small></label>
								</div>
								
							</div>
							<div class="modal-footer">
								<button  class="btn" style="background-color: #099fae !important;
  color: #fff;" name="save"><span class="glyphicon glyphicon-save"></span> บันทึก</button>
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_question').click(function(){
			$('#msg').html('')
			$('#manage_question .modal-title').html('เพิ่มข้อสอบ')
			$('#manage_question #question-frm').get(0).reset()
			$('#manage_question').modal('show')
		})
		$('.edit_question').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_question.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.qdata.id)
						$('[name="question"]').val(resp.qdata.question)
						Object.keys(resp.odata).map(k=>{
							var data = resp.odata[k]
							$('[name="question_opt['+k+']"]').val(data.option_txt);
							if(data.is_right == 1)
							$('[name="is_right['+k+']"]').prop('checked',true);
						})
						$('#manage_question .modal-title').html('แก้ไข')
						$('#manage_question').modal('show')

					}
				}
			})

		})
		$('.is_right').each(function(){
			$(this).click(function(){
				$('.is_right').prop('checked',false);
				$(this).prop('checked',true);
			})
		})
		$('.remove_question').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('ต้องการลบคำถามใช่หรือไม่');
			if(conf == true){
				$.ajax({
				url:'./delete_question.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#question-frm').submit(function(e){
			e.preventDefault();
			$('#question-frm [name="submit"]').attr('disabled',true)
			$('#question-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_question.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#quiz-frm [name="submit"]').removeAttr('disabled')
					$('#quiz-frm [name="submit"]').html('Save')
				},
				success:function(resp){
						if(resp == 1){
							alert('บันทึกคำถามสำเร็จ');
							location.reload()
						}
				}
			})
		})
		})
</script>
</html>