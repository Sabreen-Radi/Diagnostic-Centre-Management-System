<?php 
	session_start();
	if (!isset($_SESSION['admin_name'])) {
		header('Location: login.php');
		exit();
	}else{
		$admin_name = $_SESSION['admin_name'];
		include_once 'inc/db.php';
		$sqlQuery = "SELECT * FROM doctors ORDER BY id DESC LIMIT 10";
		$doctors = mysqli_query($conn, $sqlQuery);

		$sqlQuery = "SELECT * FROM appointments ORDER BY id DESC LIMIT 10";
		$appointments = mysqli_query($conn, $sqlQuery);
		$appointments2 = mysqli_query($conn, $sqlQuery);

	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagonotic Management | index</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
			<!-- message -->
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
				<!-- message -->
			<p style="font-size: 50px;" class="font-weight-bold pt-5">Welcome <?= $admin_name; ?></p>
		</div>
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 mt-5">
						<div class="list-group" id="list-tab" role="tablist">
							<a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Doctors</a>
							<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Appointments</a>
							<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Accounts</a>
						</div>
					</div>
					<div class="col-md-8 mt-5">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
								<div class="card">
									<div class="card-header text-center">
										<a href="doctor_add.php" class="btn btn-sm btn-success float-left">Add New Doctor</a>
										Latest 10 Doctors
										<a href="doctor.php" class="btn btn-sm btn-primary float-right">See All Doctors</a>
									</div>
									<div class="card-body">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
													<th>Designation</th>
													<th>Contact</th>
												</tr>
											</thead>
											<tbody>
												<?php while($doctor = mysqli_fetch_array($doctors)): ?>
													<tr>
														<td><?= $doctor['id']?></td>
														<td><?= $doctor['name']?></td>
														<td><?= $doctor['designation']?></td>
														<td><?= $doctor['contact']?></td>
													</tr>
												<?php endwhile; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
								<div class="card">
									<div class="card-header text-center">
										<a href="appointment_add.php" class="btn btn-sm btn-success float-left">Make New Appointment</a>
										Latest 10 Appointments
										<a href="appointment.php" class="btn btn-sm btn-primary float-right">See All Appointments</a>
									</div>
									<div class="card-body">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Patient Name</th>
													<th>Contact</th>
													<th>Doctor</th>
													<th>Schedule Time</th>
													<th>Total Payment</th>
												</tr>
											</thead>
											<tbody>
												<?php while($appointment = mysqli_fetch_array($appointments2)): ?>
													<tr>
														<td><?= $appointment['id']?></td>
														<td><?= $appointment['patient_name']?></td>
														<td><?= $appointment['patient_contact']?></td>
														<td><?= $appointment['patient_doc']?></td>
														<td><?= $appointment['schedule']?></td>
														<td><?= $appointment['total_amt']?></td>
													</tr>
												<?php endwhile; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
								<div class="card">
									<div class="card-header text-center">
										Billing Info (Latest 10 Patient)
										<a href="accounts.php" class="btn btn-sm btn-success float-right">See All info</a>
									</div>
									<div class="card-body">
										<table id="accounts_table" class="table table-bordered table-sm">
									<thead>
										<tr>
										<th rowspan="2">ID</th>
										<th rowspan="2">Patient Name</th>
										<th rowspan="2">Patient Contact</th>
										<th rowspan="2">Appointed To</th>
										<th colspan="5" class="text-center">Payment Details</th>
									</tr>
									<tr>
										<th>Doctor Fee (Tk.)</th>
										<th>Test Fee (TK.)</th>
										<th>Others fee (Tk.)</th>
										<th>Discount (Tk.)</th>
										<th>Total (Tk.)</th>
									</tr>
									</thead>
									<tbody>
									<?php while ($appointment = mysqli_fetch_array($appointments)): ?>
										<tr>
											<td><?= $appointment['id']?></td>
											<td><?= $appointment['patient_name']?></td>
											<td><?= $appointment['patient_contact']?></td>
											<td><?= $appointment['patient_doc']?></td>
											<td><?= $appointment['doctor_fee']?></td>
											<td><?= $appointment['test_fee']?></td>
											<td><?= $appointment['others_fee']?></td>
											<td><?= $appointment['discount_amt']?></td>
											<td><?= $appointment['total_amt']?></td>
										</tr>
									<?php endwhile; ?>
									</tbody>
								</table>
									</div>
								</div>
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