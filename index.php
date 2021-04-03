<?php
include_once "autoload.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	<?php
	// isseting student

	if(isset($_POST['stc'])){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$cell = $_POST['cell'];
		$username = $_POST['username'];
		$location = $_POST['location'];
		$age = $_POST['age'];
		$gender = $_POST['gender'];
	 	$dept = $_POST['dept'];

		// fill upload
		$file_name =$_FILES['photo']['name'];
		$file_name_tmp =$_FILES['photo']['tmp_name'];

		$fill_arr = explode('.', $file_name);
		$file_ext = end($fill_arr);

		$unique_name = md5(time() . rand()) . '.' . $file_ext;

		// form validation
		if(empty($name) || empty($email) || empty($cell) || empty($username) || empty($age)) {

		$msg= "<p class=\" alert alert-danger\">All fields are required !<button class=\"close\"
		data-dismiss=\"alert\">&times;</button></p>";
		}else if( filter_var($email, FILTER_VALIDATE_EMAIL) ==false){

			$msg= "<p class=\" alert alert-danger\">Invalid email address!<button class=\"close\"
		data-dismiss=\"alert\">&times;</button></p>";
		} else{

			// Upload form
			$sql=("INSERT INTO students (name, email, cell, username, location, age, gender, dept, photo) values('$name','$email','$cell','$username','$location','$age','$gender','$dept','$unique_name'");
			$network->query($sql);

			// Upload photo
			move_uploaded_file($file_name_tmp, 'photos/' . $unique_name);
			$msg= "<p class=\" alert alert-success\">data stable!<button class=\"close\"
		data-dismiss=\"alert\">&times;</button></p>";
		}
	}
	?>

	<div class="wrap-table">
	<a class="btn btn-primary btn-sm" data-toggle="modal" href="#add_student_modal_form">ADD NEW USERS</a>
	<br>
	<br>
	<?php
	if(isset($msg)){
		echo $msg;
	}
	?>
		<div class="card shadow">
			<div class="card-body">
				<h2>All STUDENTS</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Username</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$sql = "SELECT * FROM students";
					$data =$network->query($sql);
					$i =1;

					while($users_data = $data->fetch_object()):

					?>
						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $users_data->name ?></td>
							<td><?php echo $users_data->email ?></td>
							<td><?php echo $users_data->age ?></td>
							<td><?php echo $users_data->username ?></td>
							<td><img src="assets/media/img/pp_photo/istockphoto-615279718-612x612.jpg" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="#">View</a>
								<a class="btn btn-sm btn-warning" href="#">Edit</a>
								<a class="btn btn-sm btn-danger" href="#">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- Student crud -->
	
	<div class="modal fade" id="add_student_modal_form" >
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Add new</h3>
				</div>
				<div class="modal-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
						<label for="">Student name</label>
						<input name="name" class="form-control" type="text">
						</div>

						<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="email">
						</div>

						<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text">
						</div>

						<div class="form-group">
						<label for="">User name</label>
						<input name="username" class="form-control" type="text">
						</div>

						<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text">
						</div>

						<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location" id="">
						<option value="">-SELECT-</option>
							<option value="CTG">CTG</option>
							<option value="DHK">DHK</option>
							<option value="RAJ">RAJ</option>
							<option value="COM">COM</option>
							<option value="BAR">BAR</option>
						</select>
						</div>

						<div class="form-group">
						<label for="">Gender</label><br>
						<input name="gender" type="radio" checked value="male" id="male"><label for="male">Male</label>
						<input name="gender" type="radio" value="female" id="female"><label for="female">Female</label>
						</select>
						</div>

						<div class="form-group">
						<label for="">DEP</label>
						<select class="form-control" name="dept" id="">
						<option value="">-SELECT-</option>
							<option value="BBA">BBA</option>
							<option value="EEE">EEE</option>
							<option value="CSE">CSE</option>
							<option value="ENGLISH">ENGLISH</option>
							<option value="IT">IT</option>
							<option value="MATH">MATH</option>
						</select>
						</div>

						<div class="form-group">
						<label for="">Profile photo</label>
						<br>
						<img id="load_student_photo" style="max-width:100%;" src="" alt="">
						<br>
						<label for="student_photo"> <img width= "100px" height="100px" src="assets/media/img/upload.webp" alt=""></label>
						<input id="student_photo" name="photo" style="display: none;" class="form-control" type="file">
						</div>

						<div class="form-group">
						<label for=""></label>
						<input name="stc" class="btn btn-primary" type="submit" value="add student">						
						</div>

					</form>
				</div>
				<div class="modal-footer">
				
				</div>
			</div>
		</div>
	</div>

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		$('#student_photo').change(function(e){

			let file_url = URL.createObjectURL(e.target.files[0]);
			$('#load_student_photo').attr('src', file_url);

		});
	</script>

</body>
</html>