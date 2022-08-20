<?php
	session_start();
	if (!isset($_SESSION['admin_name'])) {
		header('Location: login.php');
		exit();
	}else{
		$admin = $_SESSION['admin_name'];
		include_once 'inc/db.php';
		$sqlQuery = "SELECT * FROM appointments ORDER BY id DESC";
		$appointments = mysqli_query($conn, $sqlQuery);
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagonotic Management | Appointments</title>
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
						<li class="nav-item">
							<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="doctor.php">Doctor</a>
						</li>
						<li class="nav-item active">
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
			<p style="font-size: 50px;" class="font-weight-bold pt-5">Welcome <?= $admin; ?></p>
		</div>
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-4 mt-5">
						<div class="list-group">
							<a href="index.php" class="list-group-item list-group-item-action">Home</a>
							<a href="appointment.php" class="list-group-item list-group-item-action active">All Appointments</a>
							<a href="appointment_add.php" class="list-group-item list-group-item-action">Make New Appointment</a>
						</div>
					</div>
					<div class="col-8 mt-5">
						<div class="card">
							<div class="card-header text-center">
								All Appointments
							</div>
							<div class="card-body">
								<table class="table table-sm table-striped table-hover" id="appointments_table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Patient Name</th>
											<th>Contact</th>
											<th>Doctor</th>
											<th>Total Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php while ($appointment = mysqli_fetch_array($appointments)): ?>
										<tr>
											<td><?= $appointment['id']; ?></td>
											<td><?= $appointment['patient_name']; ?></td>
											<td><?= $appointment['patient_contact']; ?></td>
											<td><?= $appointment['patient_doc']; ?></td>
											<td><?= $appointment['total_amt']; ?></td>
											<td>
												<a href="#" class="btn btn-sm btn-info"
												data-toggle="modal" data-target="#appointment_view_<?= $appointment['id']; ?>">View</a>
												<a href="appointment_edit.php?id=<?= $appointment['id']; ?>" class="btn btn-sm btn-success">Edit</a>
												<a onclick="return confirm('Are you sure! Do you really want to delete this?')" href="inc/appointment/delete.php?id=<?= $appointment['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
											</td>
										</tr>
										<!-- view modal -->
										<div class="modal fade" id="appointment_view_<?= $appointment['id']; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-primary">
														<h4 class="modal-title text-white text-uppercase">Appointment's Details</h4>
														<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<div class="card">
															<p style="font-size: 25px; font-weight: bold" class="text-center my-5"><?= $appointment['patient_name']; ?></p>
															<div class="row">
																<div class="col-md-6 text-right">
																	<p>Appointed To : </p>
																	<p>Contact Number :</p>
																	<p>Doctor's Fee : </p>
																	<p>Test Fee : </p>
																	<p>Others Fee : </p>
																	<p>Discount : </p>
																	<p>Total : </p>
																</div>
																<div class="col-md-6">
																	<p><?= $appointment['patient_doc']; ?></p>
																	<p><?= $appointment['patient_contact']; ?></p>
																	<p><?= $appointment['doctor_fee']; ?></p>
																	<p><?= $appointment['test_fee']; ?></p>
																	<p><?= $appointment['others_fee']; ?></p>
																	<p><?= $appointment['discount_amt']; ?></p>
																	<p><?= $appointment['total_amt']; ?></p>
																</div>
															</div>
															<!-- <div class="card-img text-center pt-5">
																<img class="img-thumbnail" src="img/doctor_img_default.png" alt="Card image" height="200px" width="200px">
															</div>
															<div class="card-body text-center">
																<p style="font-size: 25px; font-weight: bold"><?= $appointment['patient_name']; ?></p>
																<p>Appointed To: <?= $appointment['patient_doc']; ?></p>
																<p>Contact: <?= $appointment['patient_contact']; ?></p>
																<p style="font-size: 18px; font-weight: bold">Payment Details: </p>
																<p>Doctor's Fee : <?= $appointment['doctor_fee']; ?> Tk.</p>
																<p>Test Fee : <?= $appointment['test_fee']; ?> Tk.</p>
																<p>Other's Fee : <?= $appointment['others_fee']; ?> Tk.</p>
																<p>Discount : <?= $appointment['discount_amt']; ?> Tk.</p>
																<p>Total : <?= $appointment['total_amt']; ?> Tk.</p>
															</div> -->
															
														</div>
													</div>
													<div class="modal-footer bg-primary">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<!-- view modal -->
										<?php endwhile; ?>
									</tbody>
								</table>
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
		<!-- data table scripts -->
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#appointments_table').DataTable();
			});
		</script>
	</body>
</html>