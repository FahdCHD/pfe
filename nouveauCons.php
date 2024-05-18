<?php
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enregistrer"])) {
    $numCons = isset($_POST['numconsultation']) ? $_POST['numconsultation'] : "";
    $choisir_patient = isset($_POST['choisir_patient']) ? $_POST['choisir_patient'] : "";
    $choisir_situation = isset($_POST['choisir_situation']) ? $_POST['choisir_situation'] : "";
    $antecedent = isset($_POST['antecedent']) ? $_POST['antecedent'] : "";
    $motif = isset($_POST['motif']) ? $_POST['motif'] : "";
    $examen_clinique = isset($_POST['examen_clinique']) ? $_POST['examen_clinique'] : "";
    $examen_biologique = isset($_POST['examen_biologique']) ? $_POST['examen_biologique'] : "";
    $examen_radiologique = isset($_POST['examen_radiologique']) ? $_POST['examen_radiologique'] : "";
    $la_date = isset($_POST['la_date']) ? $_POST['la_date'] : "null";
    $hour = isset($_POST['hour']) ? $_POST['hour'] : "";
    $diagnostic = isset($_POST['diagnostic']) ? $_POST['diagnostic'] : "";

    // Check if the date is empty and set it to null
    if (empty($la_date)) {
        $la_date = null;
    }
    if (empty($hour)) {
        $hour = null;
    }

    $requete = "insert into consultation(NumeroConsultation ,nom_prenom_patient ,la_date,motif,situation,antecedent,examen_clinique,examen_biologique,examen_radiologique,diagnostic,heure) values(?,?,?,?,?,?,?,?,?,?,?)";
    $params = array($numCons, $choisir_patient, $la_date, $motif, $choisir_situation, $antecedent, $examen_clinique, $examen_biologique, $examen_radiologique, $diagnostic, $hour);
    $resultat = $conn->prepare($requete);
    $resultat->execute($params);

    header('location:consultation.php');
}
?>