<?php
include_once "app/db.php";
include_once "app/function.php";

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
// user data send
if(isset($_POST['add'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$age = $_POST['age'];
	$username = $_POST['username'];
if( empty($name) || empty($email) || empty($age) || empty($username)){
	$msg = "<p class=\"alert alert-danger \"> All fields are required !!<button class=\"close\" data-dismiss=\"alert\">&times;</button></p>";

}else{

$msg = "<p class=\"alert alert-success \"> Data stable
 !!<button class=\"close\" data-dismiss=\"alert\">&times;</button></p>";
 
 $network = new mysqli('localhost', 'dina', '123456', 'rahman');
$sql = "INSERT INTO student (name, email, age, username) VALUES ('$name','$email','$age','$username')";


$network->query($sql);
	}
}

?>

	<div class="wrap">
	<a class="btn btn-primary btn-sm" href="index.php">All Student</a>
	<br>
	<br>
		<div class="card">
			<div class="card-body shadow">
				<h2>ADD NEW USER</h2>
				<?php
				if(isset($msg)){
					echo $msg;
				}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="username" class="form-control" type="text">
					</div>
					<div class="form-group">
						<input name="add" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>