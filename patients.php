<?php


include "connect.php";
$nomP = isset($_GET['nomP']) ? $_GET['nomP'] : "";
$date = isset($_GET['date']) ? $_GET['date'] : "all";


$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($date == "all") {
	$sql = "SELECT * FROM patient WHERE nom_prenom_patient like '%$nomP%' limit $size
	offset $offset";


	$count = "SELECT COUNT(*) countP FROM patient WHERE nom_prenom_patient like '%$nomP%'";
} else if ($date == "r") {
	$sql = "SELECT * FROM patient WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date DESC limit $size
	offset $offset";
	$count = "SELECT COUNT(*) countP FROM patient WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date DESC ";
} else {
	$sql = "SELECT * FROM patient WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date limit $size
	offset $offset";
	$count = "SELECT COUNT(*) countP FROM patient WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date";

}
$resultatP = $conn->query($sql);
$resultatcount = $conn->query($count);
$tabcount = $resultatcount->fetch_assoc();
$numPatients = $tabcount["countP"];

$reste = $numPatients % $size;   // % operateur modulo: le reste de la division 
//euclidienne de $nbrFiliere par $size
if ($reste === 0) //$nbrFiliere est un multiple de $size
	$nbrPage = $numPatients / $size;
else
	$nbrPage = ceil($numPatients / $size);
?>






<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

	<!-- My CSS -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

	<link rel="stylesheet" href="style1.css">

</head>

<body>
	<!-- insert data -->
	<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="insertdataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="insertdataLabel">Ajouter un Patient</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" action="nouveauPat.php" class="form">
						<div class="form-group">
							<label for="nom_prenom_patient" class="form-label">Nom du patient:</label>
							<input type="text" name="nom_prenom_patient" placeholder="Nom du patient"
								class="form-control form-input" /><br>
						</div>

						<div class="form-group">
							Sexe: <br>

							<input type="radio" value="Homme" id="male" name="sexe-group" />
							<label for="male" class="form-label">Homme</label>

							<input type="radio" value="Femme" id="female" name="sexe-group" />
							<label for="female" class="form-label">Femme</label>
						</div>
						<div class="form-group">
							<label for="age_patient" class="form-label">Âge:</label>
							<input type="text" name="age_patient" placeholder="Âge" class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="mobile_patient" class="form-label">Mobile:</label>
							<input type="text" name="mobile_patient" placeholder="mobile"
								class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="ville_patient" class="form-label">Ville:</label>
							<input type="text" name="ville_patient" placeholder="ville"
								class="form-control form-input" />
						</div>

						<div class="form-group">
							<label for="situation" class="form-label">situation:</label>
							<!-- <input type="date" id="date_patient" name="la_date" class="form-control form-input" /> -->
							<select class="form-control" name="situation" id="situation">
								<option value=""></option>
								<option value="celibataire">Célibataire
								</option>
								<option value="Mariee">Mariée
								</option>
							</select>
						</div>
						<div class="form-group">
							<label for="profession" class="form-label">profession:</label>
							<input type="text" id="profession" name="profession" class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="poids" class="form-label">poids:</label>
							<input type="text" id="poids" name="poids" class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="taille" class="form-label">taille:</label>
							<input type="text" id="taille" name="taille" class="form-control form-input" />
						</div>


						<div class="form-group">
							<label for="date" class="form-label">Date:</label>
							<input type="date" id="date_patient" name="la_date" class="form-control form-input" />
						</div>

						<div class="modal-footer">
							<button type="submit" name="enregistrer" class="btn btn-primary">
								Enregistrer
							</button>
							<button type="button" name="retour" class="btn btn-secondary" data-bs-dismiss="modal">
								Fermer
							</button>
						</div>
				</div>
				</form>
			</div>

			<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
		<button type="button" class="btn btn-primary">Enregistrer</button>
	   -->
		</div>
	</div>
	</div>


	<!-- edit data -->

	<div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="editdataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editdataLabel">Modifier Patient</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" action="modifierPat.php" class="form">
						<div class="form-group">
							<!-- <label for="nom_prenom_patient" class="form-label">ID du patient:</label> -->
							<input type="hidden" name="id_patient" id="id_patient" placeholder="Nom du patient"
								class="form-control form-input" /><br>
						</div>
						<div class="form-group">
							<label for="nom_prenom_patient" class="form-label">Nom du patient:</label>
							<input type="text" name="name" id="name" placeholder="Nom du patient"
								class="form-control form-input" /><br>
						</div>

						<div class="form-group">
							Sexe: <br>

							<input type="radio" value="Homme" id="male" name="sexe-group" />
							<label for="male" class="form-label">Homme</label>

							<input type="radio" value="Femme" id="female" name="sexe-group" />
							<label for="female" class="form-label">Femme</label>
						</div>
						<div class="form-group">
							<label for="age_patient" class="form-label">Âge:</label>
							<input type="text" name="age_patient" id="age" placeholder="Âge"
								class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="mobile_patient" class="form-label">Mobile:</label>
							<input type="text" name="mobile_patient" id="mobile" placeholder="mobile"
								class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="ville_patient" class="form-label">Ville:</label>
							<input type="text" name="ville_patient" id="ville" placeholder="ville"
								class="form-control form-input" />
						</div>
						<div class="form-group">
							<label for="date" class="form-label">Date:</label>
							<input type="date" id="date_patient" name="la_date" id="date"
								class="form-control form-input" />
						</div>

						<div class="modal-footer">
							<button type="submit" name="enregistrer_update" class="btn btn-primary">
								Enregistrer
							</button>
							<button type="button" name="retour" class="btn btn-secondary" data-bs-dismiss="modal">
								Fermer
							</button>
						</div>
				</div>
				</form>
			</div>

			<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
		<button type="button" class="btn btn-primary">Enregistrer</button>
	   -->
		</div>
	</div>
	</div>

	<!-- view data -->

	<div class="modal fade" id="viewdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="viewdataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="viewdataLabel">Information</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body ">
					<div class="view_user_data">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" name="retour" class="btn btn-secondary" data-bs-dismiss="modal">
						Fermer
					</button>
				</div>
			</div>
		</div>
	</div>
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
			<li class="active">
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
			<li>
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
				<a href="Login.html" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Déconnexion </span>


				</a>
			</li>
		</ul>
	</section>
	<!-- CONTENT -->
	<section id="content">
		<nav>
			<!-- <i class='bx bx-menu' ></i> -->
			<!-- <i class='bx bx-menu'></i> -->

		</nav>

		<div class="mx-4">
			<div class="mb-3">
				<p>
				<h1><b>Patients</b></h1>
				</p>
				<br>
				<form action="patients.php" method="GET">
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
								<b>Ajouter un Patient</b>
							</button>
						</div>

					</div>
					<label for="date" style='margin-bottom:10px'> <b>Filtrer par la date</b> </label>
					<div style="width:184px;">
						<select class="form-control" name="date" id="date">
							<option value="all" <?php if ($date == "all")
								echo "selected" ?>>tout</option>
								<option value="r" <?php if ($date == "r")
								echo "selected" ?>>les plus recentes
								</option>
								<option value="a" <?php if ($date == "a")
								echo "selected" ?>>les plus anciennes
								</option>
							</select>
						</div>
						&nbsp &nbsp
					</form>
				</div>
			</div>
			<bnb></bnb>

			<!-- insert Modal  -->




			<!-- NAVBAR -->

			<main>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 style="color: #3C91E6;"><b>Liste des Patients</b></h3> <span
								style="color: #3C91E6;"><b><?php echo "($numPatients) patients" ?></b></span>

					</div>
					<table>
						<thead>
							<tr>
								<th style="display:none">Id</th>
								<th>Nom et prenom</th>
								<th>Sexe</th>
								<th>Age</th>
								<th style="display:none">Mobile</th>
								<th>Ville</th>
								<th>Date</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>

							<?php
							//read all row from database table
							// $sql = "SELECT * FROM patient";
							// $resultatP = $conn->query($sql);
							if (!$resultatP) {
								die("invalid query:" . $conn->error);
							}
							while ($patientrow = $resultatP->fetch_assoc()) { ?>
								<tr>
									<td class="user_id" style="display:none"><?php echo $patientrow['id_patient'] ?> </td>
									<td><?php echo $patientrow['nom_prenom_patient'] ?> </td>
									<td><?php echo $patientrow['sexe_patient'] ?> </td>
									<td><?php echo $patientrow['age_patient'] ?> </td>
									<td style="display:none"><?php echo $patientrow['mobile_patient'] ?> </td>
									<td><?php echo $patientrow['ville_patient'] ?> </td>
									<td><?php echo $patientrow['la_date'] ?> </td>


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
					<ul class="pagination">
						<?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
							<li style="" class="<?php if ($i == $page)
								echo '' ?>">
									<a href="patients.php?page=<?php echo $i; ?>" class="page-link">
									<?php echo $i; ?>
								</a>
							</li>&nbsp
						<?php } ?>
				</div>

				<!-- <script>
					$(document).ready(function () {
						$('.pagination .page-link').click(function (e) {
							e.preventDefault();
							var clickedPage = $(this).data('page');
							$('.pagination .page-link').css('background-color:#eeeeeee3');
							// $(this).addClass('active');
						});
					});
				</script> -->

			</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="../js/bootstrap.min.js"></script>

	<script src="script1.js"></script>

	<script src="../js/jquery-3.3.1.js"></script>

	<script>
		$('document').ready(function () {
			$('.view_data').click(function (e) {
				e.preventDefault();
				// console.log("hello");
				var user_id = $(this).closest('tr').find('.user_id').text();
				// console.log(user_id);
				$.ajax({
					method: "POST",
					url: "afficherPat.php",
					data: {
						"click_view_button": true,
						"user_id": user_id,
					},
					success: function (response) {
						$('.view_user_data').html(response)
					}
				})
			});
		});
		//edit data
		$('document').ready(function () {
			$('.edit_data').click(function (e) {
				e.preventDefault();
				// console.log("hello11");
				var user_id = $(this).closest('tr').find('.user_id').text();
				// console.log(user_id);
				$.ajax({
					method: "POST",
					url: "modifierPat.php",
					data: {
						"click_edit_button": true,
						"user_id": user_id,
					},
					success: function (response) {
						console.log(response);
						$.each(response, function (key, value) {
							$('#id_patient').val(value['id_patient']);
							$('#name').val(value['nom_prenom_patient']);
							$('input[name="sexe-group"]').val([value['sexe_patient']]);
							$('#age').val(value['age_patient']);
							$('#mobile').val(value['mobile_patient']);
							$('#ville').val(value['ville_patient']);
							$('input[name="la_date"]').val(value['la_date']);

						});
						$("#editdata").modal("show");
						// $.each(collection, function (indexInArray, valueOfElement) {

						// });
					}
				});
			});
		});
		$(document).ready(function () {
			$('.delete_data').click(function (e) {
				e.preventDefault();
				var user_id = $(this).closest('tr').find('.user_id').text();
				$.ajax({
					method: "POST",
					url: "supprimerPat.php",
					data: {
						"click_delete_button": true,
						"user_id": user_id,
					},

					success: function (response) {
						console.log(response);
						window.location.reload();
					}
				});
			})
		});
	</script>
</body>

</html>