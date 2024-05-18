<?php

include "connect.php";

$nomP = isset($_GET['nomP']) ? $_GET['nomP'] : "";
$date = isset($_GET['date']) ? $_GET['date'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($date == "all") {
	$sql = "SELECT * FROM consultation WHERE nom_prenom_patient like '%$nomP%' OR motif like '%$nomP%' limit $size
	offset $offset ";
	$count = "SELECT COUNT(*) countC FROM consultation WHERE nom_prenom_patient like '%$nomP%'";
} else if ($date == "r") {
	$sql = "SELECT * FROM consultation WHERE nom_prenom_patient like '%$nomP%' OR motif like '%$nomP%' ORDER BY la_date DESC limit $size
	offset $offset ";
	$count = "SELECT COUNT(*) countC FROM consultation WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date DESC  limit $size
	offset $offset";

} else {
	$sql = "SELECT * FROM consultation WHERE nom_prenom_patient like '%$nomP%' OR motif like '%$nomP%' ORDER BY la_date  ";
	$count = "SELECT COUNT(*) countC FROM consultation WHERE nom_prenom_patient like '%$nomP%' ORDER BY la_date";
}

$resultatC = $conn->query($sql);
$resultatcount = $conn->query($count);
$tabcount = $resultatcount->fetch_assoc();
$numConsultations = $tabcount["countC"];

$reste = $numConsultations % $size;   // % operateur modulo: le reste de la division 
//euclidienne de $nbrFiliere par $size
if ($reste === 0) //$nbrFiliere est un multiple de $size
	$nbrPage = $numConsultations / $size;
else
	$nbrPage = ceil($numConsultations / $size);
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

	<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="insertdataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="insertdataLabel">Ajouter une Consultation</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" action="nouveauCons.php" class="form">
						<div class="form-group mb-2">
							selectionné un patient
							<br>
							<select class="form-control" name="choisir_patient" style="width:100%">
								<option value="">Clique ici pour choisir</option>
								<?php
								$p = mysqli_query($conn, "SELECT * FROM patient");
								while ($c = mysqli_fetch_array($p)) {
									?>
									<option value="<?php echo $c["nom_prenom_patient"] ?>">
										<?php echo $c["nom_prenom_patient"] ?>
									</option>
								<?php } ?>
							</select>
							<br>
						</div>

						<div class="form-group mb-2">
							Numéro du consultation <br>
							<input class="form-control" type="text" id="inputField" minlength="10" maxlength="10"
								name="numconsultation" placeholder="Taper 10 caractères

">
							<div id="error" class="error-message"></div>
						</div>

						<div class="form-group mb-2">
							Situation
							<select class="form-control" name="choisir_situation" style="width:100%">
								<option value="">Clique ici pour choisir</option>
								<option value="Normal">Normal</option>
								<option value="Critique">Critique</option>
							</select>


						</div>
						<div class="form-group mb-2">
							Antécedent <br>
							<textarea name="antecedent" class="form-control"></textarea>
						</div>
						<div class="form-group mb-2">
							Motif
							<textarea name="motif" class="form-control"></textarea>
						</div>
						<div class="form-group mb-2">
							Examen Clinique
							<textarea name="examen_clinique" class="form-control"></textarea>
						</div>

						<div class="form-group mb-2">
							Examen Biologique
							<textarea name="examen_biologique" class="form-control "></textarea>

						</div>
						<div class="form-group mb-2">
							Examen radiologique
							<textarea name="examen_radiologique" class="form-control"></textarea>
						</div>
						<div class="form-group mb-2">
							Diagnostic
							<textarea name="diagnostic" class="form-control "></textarea>
						</div>
						<div class="form-group mb-2">
							Date
							<input type="date" id="date_patient" name="la_date" class="form-control" />
						</div>

						<div class="form-group mb-2">
							Heure
							<input type="time" id="hourInput" name="hour" class="form-control">
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
	<!-- edit data -->
	<!-- Button trigger modal -->


	<div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="editdataLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editdataLabel">Modifier Patient</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post" action="modifierCons.php" class="form">
						<div class="form-group mb-2">
							selectionné un patient
							<br>
							<select class="form-control" id="choisir_patient" name="choisir_patient" style="width:100%">
								<option value="">Clique ici pour choisir</option>
								<?php
								$p = mysqli_query($conn, "SELECT * FROM patient");
								while ($c = mysqli_fetch_array($p)) {
									?>
									<option value="<?php echo $c["nom_prenom_patient"] ?>">
										<?php echo $c["nom_prenom_patient"] ?>
									</option>
								<?php } ?>
							</select>
							<br>
						</div>
						<div class="form-group mb-2">
							Numéro du consultation <br>
							<input id="numconsultation" class="form-control" type="text" minlength="10" maxlength="10"
								name="numconsultation" placeholder="Taper 10 caractères

">
							<div id="error" class="error-message"></div>
						</div>

						<div class="form-group mb-2">
							Situation
							<select id="choisir_situation" class="form-control" name="choisir_situation"
								style="width:100%">
								<option value="">Clique ici pour choisir</option>
								<option value="Normal">Normal</option>
								<option value="Critique">Critique</option>
							</select>


						</div>
						<div class="form-group mb-2">
							Antécedent <br>
							<textarea id="antecedent" name="antecedent" class="form-control"></textarea>
						</div>
						<div class="form-group mb-2">
							Motif
							<textarea name="motif" class="form-control" id="motif"></textarea>
						</div>
						<div class="form-group mb-2">
							Examen Clinique
							<textarea name="examen_clinique" class="form-control" id="examen_clinique"></textarea>
						</div>
						<div class="form-group mb-2">
							Examen Biologique
							<textarea name="examen_biologique" class="form-control " id="examen_biologique"></textarea>

						</div>
						<div class="form-group mb-2">
							Examen radiologique
							<textarea id="examen_radiologique" name="examen_radiologique"
								class="form-control"></textarea>
						</div>
						<div class="form-group mb-2">
							Diagnostic
							<textarea id="diagnostic" name="diagnostic" class="form-control "></textarea>
						</div>
						<div class="form-group mb-2">
							Date
							<input type="date" id="la_date" name="la_date" class="form-control" />
						</div>
						<div class="form-group mb-2">
							Heure
							<input type="time" id="hour" name="hour" class="form-control">
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
					<div id="view_cons_data">

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
								placeholder=" Nom / motif">
							&nbsp &nbsp
							<button type="submit" class="btn btn-primary" style='font-size:78%'
								name="searchbtn"><b>Rechercher</b></button>
						</div>
						<div style="display: flex;  height: 35px;">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal"
								data-bs-target="#insertdata" style="font-size: 78%;">
								<b>Ajouter une consultation</b>
							</button>
						</div>

					</div>
					<label for="date" style='margin-bottom:10px'> <b>Filtrer par la date</b> </label>
					<div style="width:184px">
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
					</form>
				</div>
			</div>
			<bnb></bnb>

			<main>
				<div class="table-data">
					<div class="order">
						<div class="head">
							<h3 style="color: #3C91E6;"><b>Liste des Consultations</b></h3>
							<span style="color: #3C91E6;"><b><?php echo "($numConsultations) consultation" ?></b></span>
					</div>
					<table>
						<thead>
							<tr>
								<th style="display:none">Numero du Consultation</th>
								<th>Patients</th>
								<th>Date</th>
								<th>Motif</th>
								<th>Situation</th>
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
									<td class="user_id" style="display:none">
										<?php echo $consultationRow['NumeroConsultation'] ?>
									</td>
									<td><?php echo $consultationRow['nom_prenom_patient'] ?> </td>
									<td><?php echo $consultationRow['la_date'] ?> </td>
									<td><?php echo $consultationRow['motif'] ?> </td>
									<td><?php echo $consultationRow['situation'] ?> </td>
									<td style="display:none">
										<?php echo $consultationRow['heure'] ?>
									</td>
									<td style="display:none">
										<?php echo $consultationRow['antecedent'] ?>
									</td>
									<td style="display:none">
										<?php echo $consultationRow['examen_clinique'] ?>
									</td>
									<td style="display:none">
										<?php echo $consultationRow['examen_biologique'] ?>
									</td>
									<td style="display:none">
										<?php echo $consultationRow['examen_radiologique'] ?>
									</td>
									<td style="display:none">
										<?php echo $consultationRow['diagnostic'] ?>
									</td>

									<td>
										<button id='<?php echo $consultationRow['NumeroConsultation'] ?>' type="button"
											name="infoCons" class="btn btn-secondary view_data" data-bs-toggle="modal"
											data-bs-target="#viewdata">
											<i class="bi bi-info"></i>
										</button>
										<button name="modifierPat" type="button" class="btn btn-primary edit_data"
											data-bs-toggle="modal" data-bs-target="#editdata">
											<i class="bi bi-pencil"></i>
										</button>
										<button id="<?php echo $consultationRow['NumeroConsultation'] ?>" type="button"
											class="btn btn-danger delete_data">
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
									<a href="consultation.php?page=<?php echo $i; ?>" class="page-link">
									<?php echo $i; ?>
								</a>
							</li>&nbsp
						<?php } ?>
				</div>


			</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../js/jquery-3.3.1.js"></script>

	<script src="../js/bootstrap.min.js"></script>

	<!-- <script src="script1.js"></script> -->


	<script>
		$(document).ready(function () {
			$('.view_data').click(function () {
				id_emp = $(this).attr('id');
				$.ajax({
					url: "afchCons.php",
					method: 'post',
					data: { emp_id: id_emp },
					success: function (result) {
						$("#view_cons_data").html(result);
					}
				});
				$('#viewdata').modal("show");
			})

			//edit data
			$('document').ready(function () {
				$('.edit_data').click(function (e) {
					e.preventDefault();
					// // console.log("hello11");
					// var user_id = $(this).closest('tr').find('.user_id').text();
					// // console.log(user_id);
					// $.ajax({
					// 	method: "POST",
					// 	url: "modifierCons.php",
					// 	data: {
					// 		"click_edit_button": true,
					// 		"user_id": user_id,
					// 	},
					// 	success: function (response) {
					// 		$.each(response, function (key, value) {
					// 			$('#choisir_patient').val(value['nom_prenom_patient']);
					// 			$('#numero_cons').val(value['NumeroConsultation']);
					// 			$('input[name="choisir_situation"]').val([value['situation']]);
					// 			$('#antecedent').val(value['antecedent']);
					// 			$('#motif').val(value['motif']);
					// 			$('#examen_clinique').val(value['examen_clinique']);
					// 			$('#examen_biologique').val(value['examen_biologique']);
					// 			$('#examen_radiologique').val(value['examen_radiologique']);
					// 			$('#diagnostic').val(value['diagnostic']);
					// 			$('#la_date').val(value['la_date']);
					// 			$('#hour').val(value['heure']);

					// 		});
					// 		$("#editdata").modal("show");

					// 	}
					// });

					var tr = $(this).closest('tr');

					var data = tr.children("td").map(function () {
						return $(this).text();
					}).get();

					console.log(data);

					$('#numconsultation').val(data[0]);
					$('#choisir_patient').val(data[1]);
					$('#la_date').val(data[2]);
					$('#motif').val(data[3]);
					$('#choisir_situation').val(data[4]);
					$('#hour').val(data[5]);
					$('#antecedent').val(data[6]);
					$('#examen_clinique').val(data[7]);
					$('#examen_biologique').val(data[8]);
					$('#examen_radiologique').val(data[9]);
					$('#diagnostic').val(data[10]);

				});
			});

			// delete
			$(document).ready(function () {
				$('.delete_data').click(function (e) {
					e.preventDefault();
					var user_id = $(this).attr('id');
					$.ajax({
						method: "post",
						url: "supprimerCons.php",
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
		})
	</script>
</body>

</html>