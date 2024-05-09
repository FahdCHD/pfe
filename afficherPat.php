<?php
include "connect.php";
if (isset($_POST["click_view_button"])) {
    $id_pat = $_POST["user_id"];

    $sql = "SELECT * FROM patient WHERE id_patient = '$id_pat'";

    $resultatP = $conn->query($sql);
    if (!$resultatP) {
        die("invalid query:" . $conn->error);
    }
    while ($row = $resultatP->fetch_assoc()) {
        echo "<h5>ID: </h5>" . $row["id_patient"];
        echo "<h5>Nom et Prenom: </h5>" . $row["nom_prenom_patient"];
        echo "<h5>Sexe: </h5>" . $row["sexe_patient"];
        echo "<h5>Age: </h5>" . $row["age_patient"];
        echo "<h5>Ville: </h5>" . $row["ville_patient"];
        echo "<h5>Mobile: </h5>" . $row["mobile_patient"];
        echo "<h5>Profession: </h5>" . $row["profession"];
        echo "<h5>Situation: </h5>" . $row["situation"];
        echo "<h5>Poids(Kg): </h5>" . $row["poids"];
        echo "<h5>Taille(Cm): </h5>" . $row["taille"];
        echo "<h5>Date: </h5>" . $row["la_date"];

    }
}
?>