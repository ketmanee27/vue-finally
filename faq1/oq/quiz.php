<!DOCTYPE html>
<html lang="en">
<head>
    </head>
    <?php include('header.php') ?>
    <?php include('auth.php') ?>
    <?php include('db_connect.php') ?>
    <title>จัดการแบบทดสอบ</title>
    <link rel="stylesheet" href="css/content.css">
    <style>
        .container-fluid{
    margin-top:40px
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
        <div class="col-md-12 alert alert-primary">แบบทดสอบ</div>
        <button class="btn bt-sm" id="new_quiz"><i class="fa fa-plus"></i>  เพิ่มข้อสอบ</button>
        <br>
        <br>
        <div class="card col-md-12">
            <div class="card-body">
                <table class="table table-bordered" id='table'>    
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อบทเรียน</th>
                            <th scope="col">จำนวนคำถาม</th>
                            <th scope="col">คะแนนคำตอบ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                  $where = '';
				  $qry = $conn->query("SELECT * FROM quiz_list ");
				  $i = 1;
				  if($qry->num_rows > 0){
					  while($row= $qry->fetch_assoc()){
						  $items = $conn->query("SELECT count(id) as item_count from questions where qid = '".$row['id']."' ")->fetch_array()['item_count'];
					  ?>
                    <tr>
                        <td data-label="#"><?php echo $i++ ?></td>
                        <td data-label="ชื่อบทเรียน"><?php echo $row['title'] ?></td>
                        <td data-label="จำนวนคำถาม"><?php echo $items ?> คำถาม</td>
                        <td data-label="คะแนนคำตอบ"><?php echo $row['qpoints'] ?> คะแนน</td>
                        <td>
                            <center>
                             <a class="btn btn-sm edit_quiz" style="background-color:#fcad74 !important;
  color: #fff;" href="./quiz_view.php?id=<?php echo $row['id']?>"><i class="fa fa-task"></i> จัดการ</a>
                             <button class="btn btn-sm edit_quiz" style="background-color: #56a062  !important;
  color: #fff;" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i> แก้ไข</button>
                            <button class="btn btn-sm remove_quiz" style="background-color: #ea5859  !important;
  color: #fff;" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i> ลบ</button>
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
    <?php
                            //1. เชื่อมต่อ database:
                            include('db_connect.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
                            //2. query ข้อมูลจากตาราง tb_member:
                            $query = "SELECT * FROM lesson ORDER BY lesson_id asc" or die("Error:" . mysqli_error());
                            //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
                            $result = mysqli_query($conn, $query);?>

    <div class="modal fade" id="manage_quiz" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <h4 class="modal-title" id="myModallabel">เพิ่มข้อสอบ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id='quiz-frm'>
                            <div class ="modal-body">
                                <div id="msg"></div>
                                <div class="form-group">
                                    <label>บทเรียน</label>
                                    <input type="hidden" name="id" />

                                    <select  name="title" class="form-control" required="required" >
                                        <?php foreach($result as $results){?>
                                        <option value="<?php echo $results["lesson_name"];?>">
                                        บทที่
                                        <?php echo  $results["lesson_id"]; ?>
                                        <?php echo  $results["lesson_name"]; ?>
                                    </option>
                                        <?php } ?>
                                    </select>
                                    <!-- <input type="hidden" name="id" />
                                    <input type="text" name="title" required="required" class="form-control" /> -->
                                </div>
                                <div class="form-group">
                                    <label>คะแนนคำตอบ</label>
                                    <input type="nember" name ="qpoints" required="" class="form-control" />
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
		$('#new_quiz').click(function(){
    $('#msg').html('')
    $('#manage_quiz .modal-title').html('เพิ่มข้อสอบ')
    $('#manage_quiz #quiz-frm').get(0).reset()
    $('#manage_quiz').modal('show')
})
		$('.edit_quiz').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_quiz.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="title"]').val(resp.title)
						$('[name="qpoints"]').val(resp.qpoints)
						$('#manage_quiz .modal-title').html('แก้ไข')
						$('#manage_quiz').modal('show')

					}
				}
			})

		})
		$('.remove_quiz').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('ต้องการลบข้อสอบใช่หรือไม่');
			if(conf == true){
				$.ajax({
				url:'./delete_quiz.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#quiz-frm').submit(function(e){
			e.preventDefault();
			$('#quiz-frm [name="submit"]').attr('disabled',true)
			$('#quiz-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_quiz.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#quiz-frm [name="submit"]').removeAttr('disabled')
					$('#quiz-frm [name="submit"]').html('Save')
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
</body>
</html>
