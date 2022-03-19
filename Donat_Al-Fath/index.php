<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-5">
				<div class="wrap">
					<div class="img" style="background-image: url(images/bg-1.jpg);"></div>
					<div class="login-wrap p-4 p-md-5">
				<div class="d-flex">
					<div class="w-100">
						<h3 class="mb-4 text-center">Login Admin Donat Al-Fath</h3>
					</div>
				</div>
				<form action="" method="POST" class="signin-form">
					<div class="form-group mt-3">
						<input type="text" class="form-control" name="username" required>
						<label class="form-control-placeholder" for="username">Username</label>
					</div>
				<div class="form-group">
					<input id="password-field" type="password" name="password" class="form-control" required>
					<label class="form-control-placeholder" for="password">Password</label>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
				</div>
				</form>	
			</div>
			</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>

	</body>
</html>

