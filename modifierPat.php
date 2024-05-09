<?php
include "connect.php";

if (isset($_POST["click_edit_button"])) {
    $id_pat = $_POST["user_id"];
    $arrayresult = [];
    $sql = "SELECT * FROM patient WHERE id_patient = '$id_pat'";

    $resultP = $conn->query($sql);
    if (!$resultP) {
        echo "error" . $conn->error;
    }
    while ($row = $resultP->fetch_assoc()) {
        array_push($arrayresult, $row);
        header("content-type: application/json");
        echo json_encode($arrayresult);
    }
}
if (isset($_POST["enregistrer_update"])) {
    $id_patient = $_POST["id_patient"];
    $nom = $_POST["name"];
    $sexe_patient = $_POST["sexe-group"];
    $age_patient = $_POST["age_patient"];
    $mobile_patient = $_POST["mobile_patient"];
    $ville_patient = $_POST["ville_patient"];
    $la_date = $_POST["la_date"];

    $sql = "UPDATE patient SET nom_prenom_patient = '$nom', sexe_patient = '$sexe_patient',age_patient = $age_patient, mobile_patient = $mobile_patient, ville_patient='$ville_patient',la_date ='$la_date' WHERE id_patient = '$id_patient'";
    if (!$conn->query($sql)) {
        echo "error" . $conn->error;
    }
    header('Location: patients.php');
}
?>