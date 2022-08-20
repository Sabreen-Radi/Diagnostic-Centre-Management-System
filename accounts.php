<?php 
	session_start();
	if (!isset($_SESSION['admin_name'])) {
		header('Location: login.php');
		exit();
	}else{
		$admin_name = $_SESSION['admin_name'];
		include_once 'inc/db.php';
		
		$sqlQuery = "SELECT * FROM appointments ORDER BY id DESC LIMIT 10";
		$appointments = mysqli_query($conn, $sqlQuery);
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Diagonotic Management | Accounts</title>
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
						<li class="nav-item">
							<a class="nav-link" href="appointment.php">Appointment</a>
						</li>
						<li class="nav-item active">
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
					<div class="col-md-12 mt-5">
						<div class="card">
							<div class="card-header bg-primary text-white text-center">
								<span style="font-size: 20px; font-weight: bold;">Billing Info</span>
								<a href="inc/pdf.php" target="_blank" class="btn btn-md btn-success float-right">Pdf / Print</a>
								<a href="inc/email.php" target="_blank" class="btn btn-md btn-success float-right mr-2">Email</a>
								<a href="index.php" class="btn btn-md btn-success float-left">Back To Home</a>
							</div>
							<div class="card-body">
								<table id="accounts_table" class="table table-bordered">
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
				$('#accounts_table').DataTable();
			});
		</script>
	</body>
</html>