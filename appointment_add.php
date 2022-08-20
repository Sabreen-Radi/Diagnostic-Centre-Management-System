<?php
	session_start();
	if (!isset($_SESSION['admin_name'])) {
		header('Location: login.php');
		exit();
	}else{
		$admin = $_SESSION['admin_name'];
		include_once 'inc/db.php';
		$sqlQuery = "SELECT * FROM doctors ORDER BY id DESC";
		$doctors = mysqli_query($conn, $sqlQuery); 
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagonotic Management | Make Appointment</title>
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
							<a href="appointment.php" class="list-group-item list-group-item-action">All Appointments</a>
							<a href="appointment_add.php" class="list-group-item list-group-item-action active">Make New Appointment</a>
						</div>
					</div>
					<div class="col-8 mt-5">
						<div class="card">
							<div class="card-header text-center bg-primary text-white">
								Make New Appointment
							</div>
							<div class="card-body">
								<form action="inc/appointment/store.php" method="POST" enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="patient_name">Patient Name:</label>
												<input type="text" id="patient_name" class="form-control form-control-sm" name="patient_name" placeholder="Patient Name e.g. Mr. / Mrs. Someone...">
											</div>
											<div class="form-group">
												<label for="birthday">Date of Birth:</label>
												<input type="date" id="birthday" class="form-control form-control-sm" name="birthday" placeholder="Date of Birth...">
											</div>
											<div class="form-group">
												<label for="patient_doc">Select a Doctor:</label>
												<select name="patient_doc" id="patient_doc" class="form-control form-control-sm">
													<?php while($doctor = mysqli_fetch_array($doctors)): ?>
														<option value="<?= $doctor['name']; ?>"><?= $doctor['name']; ?></option>
													<?php endwhile; ?>
												</select>
											</div>
											<div class="form-group">
												<label for="test_fee">Test Fee:</label>
												<input type="text" class="form-control form-control-sm" id="test_fee" name="test_fee" placeholder="Test Fee ....">
											</div>
											<div class="form-group">
												<label for="other_fee">Other's Fee:</label>
												<input type="text" class="form-control form-control-sm" id="other_fee" name="other_fee" placeholder="Other's fee e.g. medicine, instuments etc ....">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="patient_sex">Sex:</label><br>
												<label class="radio-inline mr-5"><input type="radio" name="patient_sex" value="Male" checked> Male</label>
												<label class="radio-inline"><input type="radio" name="patient_sex" value="Female"> Female</label>
											</div>
											<div class="form-group">
												<label for="patient_contact">Contact Number:</label>
												<input type="text" id="patient_contact" class="form-control form-control-sm" name="patient_contact" placeholder="Contact Number...">
											</div>
											<div class="form-group">
												<label for="schedule">Select a Schedule for visit:</label>
												<select name="schedule" id="schedule" class="form-control form-control-sm">
													<option value="10 AM - 12 PM">10 AM - 12 PM</option>
													<option value="02 PM - 04 PM">02 PM - 04 PM</option>
													<option value="06 PM - 08 PM">06 PM - 08 PM</option>
													<option value="08 AM - 10 PM">08 AM - 10 PM</option>
												</select>
											</div>
											<div class="form-group">
												<label for="doctor_fee">Doctor's Fee:</label>
												<input type="text" class="form-control form-control-sm" id="doctor_fee" name="doctor_fee" placeholder="Fee of Doctor ....">
											</div>
											<div class="form-group">
												<label for="discount">Discount (%):</label>
												<input type="text" class="form-control form-control-sm" id="discount" name="discount" placeholder="Discount e.g. 10% ....">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="disease_des">A short Description about Patient & Disease: </label>
										<textarea name="disease_desc" id="disease_des" class="form-control form-control-sm" rows="6" placeholder="Short description about patient current physical condition and Disease..."></textarea>
									</div>
									<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Submit">
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