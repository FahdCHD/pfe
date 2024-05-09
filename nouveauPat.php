<?php
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enregistrer"])) {
    $nom_prenom_patient = isset($_POST['nom_prenom_patient']) ? $_POST['nom_prenom_patient'] : "";
    $sexe_patient = isset($_POST['sexe-group']) ? $_POST['sexe-group'] : "";
    $age_patient = isset($_POST['age_patient']) ? $_POST['age_patient'] : 0;
    $mobile_patient = isset($_POST['mobile_patient']) ? $_POST['mobile_patient'] : "";
    $ville_patient = isset($_POST['ville_patient']) ? $_POST['ville_patient'] : "";
    $la_date = isset($_POST['la_date']) ? $_POST['la_date'] : "";
    $poids = isset($_POST['poids']) ? $_POST['poids'] : "";
    $taille = isset($_POST['taille']) ? $_POST['taille'] : "";
    $profession = isset($_POST['profession']) ? $_POST['profession'] : "";
    $situation = isset($_POST['situation']) ? $_POST['situation'] : "";


    $requete = "insert into patient(nom_prenom_patient,sexe_patient,age_patient,mobile_patient,ville_patient,la_date,situation,profession,poids,taille) values(?,?,?,?,?,?,?,?,?,?)";
    $params = array($nom_prenom_patient, $sexe_patient, $age_patient, $mobile_patient, $ville_patient, $la_date, $situation, $profession, $poids, $taille);
    $resultat = $conn->prepare($requete);
    $resultat->execute($params);

    header('location:patients.php');
}
?>