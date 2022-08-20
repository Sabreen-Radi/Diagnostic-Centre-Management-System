<?php
	session_start();

	if (isset($_SESSION['admin_name'])) {
		header('Location: index.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagnostic Management | LogIn</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</head>
	<body>
		<div class="wrapper" style="background: url('img/login_banner.png') no-repeat center; background-size: 100% 100%; height: 100vh; width: 100%; padding-top: 50px;" >
			<div class="card p-3 mx-auto border border-primary" style="width: 320px; height: auto; ">
				<img src="img/login_card_img_2.jpg" class="card-img-top img-thumbnail" alt="Card Image" style="width: 100%; height: 180px;">
				<hr>
				<div class="body">
					<?php if(isset($_SESSION['error'])): ?>
						<div class="alert alert-danger">
							<?= $_SESSION['error']; ?>
							<?php 
								unset($_SESSION['error']);
							?>
						</div>
					<?php endif; ?>	

					<?php if(isset($_SESSION['success'])): ?>
						<div class="alert alert-success">
							<?= $_SESSION['success']; ?>
							<?php 
								unset($_SESSION['success']);
							?>
						</div>
					<?php endif; ?>	
					<form action="inc/login.inc.php" method="POST">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email...">
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password...">
						</div>
						<input type="submit" class="btn btn-md btn-primary float-right" name="submit" value="Submit">
					</form>
				</div>
			</div>	
		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</body>
</html>