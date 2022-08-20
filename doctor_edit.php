<?php
	session_start();
	if (!isset($_SESSION['admin_name'])) {
		header('Location: login.php');
		exit();
	}else{
		$admin = $_SESSION['admin_name'];
		if (isset($_GET['id'])) {
			include_once 'inc/db.php';
			$id = $_GET['id'];
			$sqlQury = "SELECT * FROM doctors WHERE id = '$id'";
			$result = mysqli_query($conn, $sqlQury);
			while ($row = mysqli_fetch_array($result)) {
				$doctorName = $row['name'];
				$doctorDesig = $row['designation'];
				$doctorCont = $row['contact'];
				$docImg = $row['image'];
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagonotic Management | index</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	</head>
	<body style="background: #ECF0F5;">
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
				<a class="navbar-brand" href="index.php">Diagnostic Management</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="doctor.php">Doctor</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="appointment.php">Appointment</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="accounts.php">Accounts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="inc/logout.inc.php">Logout</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="mt-5 text-center" style="background: url('img/banner.jpg') no-repeat center; height: 300px; width: 100%; background-size: cover;">
	<!-- success or error message -->
				<?php if(isset($_SESSION['success'])): ?>
				<div class="container">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								<?= $_SESSION['success']; ?>
								<?php
									unset($_SESSION['success']);
								?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if(isset($_SESSION['error'])): ?>
				<div class="container">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								<?= $_SESSION['error']; ?>
								<?php
									unset($_SESSION['error']);
								?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<!-- success or error message -->
			<p style="font-size: 50px;" class="font-weight-bold pt-5">Welcome <?= $admin; ?></p>
		</div>
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-4 mt-5">
						<div class="list-group">
							<a href="index.php" class="list-group-item list-group-item-action">Home</a>
							<a href="doctor.php" class="list-group-item list-group-item-action">All Doctors</a>
							<a href="doctor_add.php" class="list-group-item list-group-item-action active">Add Doctor</a>
						</div>
					</div>
					<div class="col-8 mt-5">
						<div class="card">
							<div class="card-header text-center">
								Add New Doctors
							</div>
							<div class="card-body">
								<div class="text-center">
									<?php if (!empty($docImg)): ?>
										<img class="img-thumbnail" src="img/Uploads/<?= $docImg; ?>" alt="Card image" style="height: 200px;width: 200px;">
									<?php else: ?>
										<img class="img-thumbnail" src="img/doctor_img_default.png" alt="Card image" height="200px" width="200px">
									<?php endif ?>
								</div>
								<form action="inc/doctor/update.php" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?= $id; ?>">
									<div class="form-group">
										<label for="doctor_name">Doctor Name:</label>
										<input type="text" value ="<?= $doctorName; ?>" id="doctor_name" class="form-control" name="doctor_name" placeholder="Doctor Name e.g. Dr. Someone...">
									</div>
									<div class="form-group">
										<label for="doctor_designation">Doctor Degisnation:</label>
										<input type="text" value ="<?= $doctorDesig; ?>" id="doctor_designation" class="form-control" name="doctor_designation" placeholder="Doctor Degisnation e.g. Assistant Prof...">
									</div>
									<div class="form-group">
										<label for="doctor_contact">Contact Number:</label>
										<input type="text" value ="<?= $doctorCont; ?>" id="doctor_contact" class="form-control" name="doctor_contact" placeholder="Contact Number...">
									</div>
									<div class="form-group">
										<label for="doctor_img">Doctor Image:</label>
										<input type="file" id="doctor_img" class="form-control" name="doctor_img">
									</div>
									<input type="submit" name="submit" class="btn btn-sm btn-success" value="Update">
									<a href="doctor.php" class="btn btn-sm btn-primary">Back</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="bg-primary text-white p-2 mt-5 text-center">
				<p>Copyright &copy; All right reserved by Diagnostic Management.</p>
			</div>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</body>
</html>