<?php
    include "connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["enregistrer"])){
    $nom_prenom_patient=isset($_POST['nom_prenom_patient'])?$_POST['nom_prenom_patient']:"";
    $sexe_patient=isset ($_POST['sexe-group'])?$_POST['sexe-group']:"";
    $age_patient=isset ($_POST['age_patient'])?$_POST['age_patient']:"";
    $mobile_patient=isset ($_POST['mobile_patient'])?$_POST['mobile_patient']:"";
    $ville_patient=isset ($_POST['ville_patient'])?$_POST['ville_patient']:"";
    $la_date=isset ($_POST['la_date'])?$_POST['la_date']:"";
    
    $requete="insert into patient(nom_prenom_patient,sexe_patient,age_patient,mobile_patient,ville_patient,la_date) values(?,?,?,?,?,?)";
    $params=array($nom_prenom_patient,$sexe_patient,$age_patient,$mobile_patient,$ville_patient,$la_date);
    $resultat=$conn->prepare($requete);
    $resultat->execute($params);
    
    header('location:consultation.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter nouveau Consultation</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Boxicons -->
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<!-- My CSS -->
 
    <link rel="stylesheet" href="style1.css">
    <style>
       
       .btn-container {
            text-align: center;  
            margin-top: 10px;
            color: blue;
            padding: 10px;
        }

        .form-box {
            width: 500px; /* Longueur du box */
            padding: 20px; /* Ajoute un espacement intérieur */
            border: 1px solid #ccc; /* Ajoute une bordure */
            box-shadow: 0 6px 6px rgba(0, 0, 0, 0.1);
            background-color:white;
            border-radius:10px;
        }
        .container {
            width: 1500px; /* Ajuste la largeur du container selon tes besoins */
            margin: 50px auto; /* Centre le container horizontalement */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-input {
            width: 100%; /* Ajuste la longueur des placeholders sur toute la largeur */
        }

        .form-label {
            text-align: right; /* Aligne les labels à droite */
            padding-right: 10px; /* Ajoute un espacement à droite des labels */
        }
  
           

    </style>
</head>
<body>

<section id="sidebar">
		<a href="#" class="brand">
      <img src="c:\Users\Ahmed\Downloads\Design_sans_titre__1_-removebg-preview.png" width="180" height="180" >

		</a>
		<ul class="side-menu top">
			<li>
				<a  href="#">
					<i class='bx bx-home'></i>
					<span class="text">Tableau de bord</span>
				</a>
			</li>
			<li class="#">
				<a href="patients.php">
					<i class='bx bxs-group' ></i>
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
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
				<a href= "Login.html" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Déconnexion </span>
					

				</a>
			</li>
		</ul>
	</section>
    <div class="container ">
    <div class=" box form-box">

            <div class="panel-heading"><h3>Ajouter un nouveau patient</h3>
        &nbsp</div>
            <div class="panel-body">
                <form method="post" action="nouveauPat.php" class="form">
                    <div class="form-group">
                        <label for="nom_prenom_patient" class="form-label">Nom du patient:</label>
                        <input type="text" name="nom_prenom_patient" placeholder="Nom du patient" class="form-control form-input"/><br>
                    </div>
                   
                    <div class="form-group">
                        Sexe: <br>
                        
                        <input type="radio" value="Homme" id="male" name="sexe-group" />
                        <label for="male" class="form-label">Homme</label>
                    
                        <input type="radio" value="Femme" id="female" name="sexe-group"/>
                        <label for="female" class="form-label">Femme</label>
                    </div>
                    <div class="form-group">
                        <label for="age_patient" class="form-label">Âge:</label>
                        <input type="text" name="age_patient" placeholder="Âge" class="form-control form-input"/>
                    </div>
                    <div class="form-group">
                        <label for="mobile_patient" class="form-label">Mobile:</label>
                        <input type="text" name="mobile_patient" placeholder="mobile" class="form-control form-input"/>
                    </div>
                    <div class="form-group">
                        <label for="ville_patient" class="form-label">Ville:</label>
                        <input type="text" name="ville_patient" placeholder="ville" class="form-control form-input"/>
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" id="date_patient" name="la_date" class="form-control form-input"/>
                    </div>
                    
                    <div class="btn-container">
                    <button type="submit" name="enregistrer"  class="btn btn-primary" >
                        Enregistrer
                    </button>
                    <button type="submit" name="retour" class="btn btn-primary" >
                    <a href="patients.php" style="color:white"> Retour </a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>