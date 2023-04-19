<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>แบบทดสอบ</title>
	<link rel="stylesheet" href="css/content.css">
	<style>
	.alert{
		background-color: #fff !important;
		border-style: solid !important;
  		border-color: #099fae !important;
		  border-radius: 5px;
		  margin-left:auto;
    margin-right:auto;
	}
.container-fluid{
	margin-top:40px
}
.card{
    margin-left:auto;
    margin-right:auto;
}
th {
  background-color: #fcad74;
  color: white;
}
table th {
    font-size: 1em !important;
    letter-spacing: .1em;
    text-transform: uppercase;
  }
	</style>
</head>
<body>
	
	<?php include('nav_bar.php') ?>
	<div class="container-fluid admin">
		<div class="col-md-12 alert">แบบทดสอบ</div>
		<br>
		<div class="card col-md-12">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<thead>
						<tr>
							<th>#</th>
							<th>บทเรียน</th>
							<th>คะแนน</th>
							<th>สถานะ</th>
							<th>ข้อสอบ</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT * from  quiz_list where id ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
							$status = $conn->query("SELECT * from history where quiz_id = '".$row['id']."' and user_id ='".$_SESSION['login_id']."' ");
							$hist = $status->fetch_array();
						?>
					<tr>
						<td data-label="#"><?php echo $i++ ?></td>
						<td data-label="บทเรียน"><?php echo $row['title'] ?></td>
						<td data-label="คะแนน"><?php echo $status->num_rows > 0 ? $hist['score'].'/'.$hist['total_score'] : '-' ?> คะแนน</td>
						<td data-label="สถานะ"><?php echo $status->num_rows > 0 ? 'สอบแล้ว' : 'ยังไม่ทำข้อสอบ' ?></td>
						<td>
							<center>
							 	<?php if($status->num_rows <= 0): ?>
							 	<a class="btn btn-sm btn2" style="background-color: #099fae !important;
  color: #fff;" href="./answer_sheet.php?id=<?php echo $row['id']?>"><i class="fa fa-pencil"></i> ทำข้อสอบ</a>
								<?php else: ?>
								
								<p style="color:#fcad74">ระบบจะไม่แสดงเฉลย</p>
							<?php endif; ?>
							</center>
						</td>
					</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_faculty').click(function(){
			$('#msg').html('')
			$('#manage_faculty .modal-title').html('Add New Faculty')
			$('#manage_faculty #faculty-frm').get(0).reset()
			$('#manage_faculty').modal('show')
		})
		$('.edit_faculty').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="uid"]').val(resp.uid)
						$('[name="name"]').val(resp.name)
						$('[name="subject"]').val(resp.subject)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('#manage_faculty .modal-title').html('Edit Faculty')
						$('#manage_faculty').modal('show')

					}
				}
			})

		})
		$('.remove_faculty').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('ต้องการลบข้อมูลใช่หรือไม่');
			if(conf == true){
				$.ajax({
				url:'./delete_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#faculty-frm').submit(function(e){
			e.preventDefault();
			$('#faculty-frm [name="submit"]').attr('disabled',true)
			$('#faculty-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_faculty.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#faculty-frm [name="submit"]').removeAttr('disabled')
					$('#faculty-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('บันทึกข้อสอบสำเร็จ');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})
</script>
</html>