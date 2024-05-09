<?php

include "connect.php";

$nomP = isset($_GET['nomP']) ? $_GET['nomP'] : "";
$date = isset($_GET['date']) ? $_GET['date'] : "all";

if ($date == "all") {
	$sql = "SELECT * FROM consultation WHERE consultation.nom_prenom_patient like '%$nomP%'";
} else if ($date == "r") {
	$sql = "SELECT * FROM consultation WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date DESC";
} else {
	$sql = "SELECT * FROM consultation WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date";
}

$resultatC = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	<!-- My CSS -->
	<link rel="stylesheet" href="style1.css">

</head>

<body>
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="" width="180" height="180">

		</a>
		<ul class="side-menu top">
			<li>
				<a href="#">
					<i class='bx bx-home'></i>
					<span class="text">Tableau de bord</span>
				</a>
			</li>
			<li class="#">
				<a href="patients.php">
					<i class='bx bxs-group'></i>
					<span class="text">Patients</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-calendar'></i>
					<span class="text">Rendez vous </span>
				</a>
			</li>
			<li class="active">
				<a href="consultation.php">
					<i class="bx bx-calendar-check"></i>

					<span class="text">Consultations</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-file'></i>
					<span class="text">Ordonnances et Certificats</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="bx bx-receipt"></i>

					<span class="text">Facturation</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
				<a href="Login.html" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Déconnexion </span>


				</a>
			</li>
		</ul>
	</section>
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<!-- <form action="consultation.php" method="GET">
				<div class="form-input">
					<input type="text" name="nomP" placeholder="Nom">

					<label for="date"> date: </label>
					<select class="form-control" name="date" id="date">
						<option value="all">tout</option>
						<option value="r">les plus recentes</option>
						<option value="a">les plus anciennes</option>
					</select>
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
					<a href="nouveauCons.php" style="text-decoration:none" target="_blank">ajouter consultation</a>
				</div>


			</form> -->
		</nav>
		<!-- NAVBAR -->

		<div class="mx-4">
			<div class="mb-3">
				<p>
				<h1><b>Consultations</b></h1>
				</p>
				<br>
				<form action="consultation.php" method="GET">
					<div class="form-input" style="display:flex; justify-content: space-between;
margin-bottom:10px;">
						<div style="display: flex;  height: 35px;">
							<input style="border:1px solid #bbbbbb ; border-radius:4px" type="text" name="nomP"
								placeholder="Taper le nom du patient">
							&nbsp &nbsp
							<button type="submit" class="btn btn-primary" style='font-size:78%'
								name="searchbtn"><b>Rechercher</b></button>
						</div>
						<div style="display: flex;  height: 35px;">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#insertdata" style="font-size: 78%;">
								<b>Ajouter Patient</b>
							</button>
						</div>

					</div>
					<label for="date" style='margin-bottom:10px'> <b>Filtrer par la date</b> </label>
					<div style="width:184px">
						<select class="form-control" name="date" id="date">
							<option value="all" <?php if ($date == "all")
								echo "selected" ?>>tout</option>
								<option value="r" <?php if ($date == "r")
								echo "selected" ?>>les plus recentes</option>
								<option value="a" <?php if ($date == "a")
								echo "selected" ?>>les plus anciennes</option>
							</select>
						</div>
					</form>
				</div>
			</div>
			<bnb></bnb>

			<main>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 style="color: #3C91E6;"><b>Liste des Consultations</b></h3>
						</div>
						<table>
							<thead>
								<tr>
									<th style="display:none">Id</th>
									<th>Patients</th>
									<th>Date</th>
									<th>Motif</th>

									<th>Action</th>

								</tr>
							</thead>
							<tbody>
								<?php

							// $sql = "SELECT * FROM consultation";
							// $resultatC = $conn->query($sql); 
							if (!$resultatC) {
								die("invalid query:" . $conn->error);
							}
							while ($consultationRow = $resultatC->fetch_assoc()) { ?>
								<tr>
									<td style="display:none"><?php echo $consultationRow['id_patient'] ?> </td>
									<td><?php echo $consultationRow['nom_prenom_patient'] ?> </td>
									<td><?php echo $consultationRow['la_date'] ?> </td>
									<td><?php echo $consultationRow['motif'] ?> </td>

									<td>
										<button type="button" name="infoPat" class="btn btn-secondary view_data"
											data-bs-toggle="modal" data-bs-target="#viewdata">
											<i class="bi bi-info"></i>
										</button>
										<button name="modifierPat" type="button" class="btn btn-primary edit_data"
											data-bs-toggle="modal" data-bs-target="#editdata">
											<i class="bi bi-pencil"></i>
										</button>
										<button type="button" class="btn btn-danger delete_data">
											<i class="bi bi-trash"></i>
										</button>
									</td>
								<?php } ?>

						</tbody>
					</table>
				</div>


			</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../js/bootstrap.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

	<script src="script1.js"></script>
</body>

</html>