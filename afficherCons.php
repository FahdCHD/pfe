<?php
include "connect.php";
if (isset($_POST["click_view_button"])) {
    $numCons = $_POST["num_cons"];

    $sql = "SELECT * FROM consultation WHERE NumeroConsultation = '$numCons'";

    $resultatC = $conn->query($sql);
    if (!$resultatC) {
        die("invalid query:" . $conn->error);
    }
    while ($row = $resultatC->fetch_assoc()) {

        echo "<h5>Nom et prenom du patient: </h5>" . $row["nom_prenom_patient"];
        echo "<h5>Numéro de la consultation: </h5>" . $row["NumeroConsultation"];
        echo "<h5>Situation: </h5>" . $row["situation"];
        echo "<h5>Antécédent: </h5>" . $row["antecedent"];
        echo "<h5>Motif: </h5>" . $row["motif"];
        echo "<h5>Examen clinique: </h5>" . $row["examen_clinique"];
        echo "<h5>Examen biologique: </h5>" . $row["examen_biologique"];
        echo "<h5>Examen radiologique(Kg): </h5>" . $row["examen_radiologique"];
        echo "<h5>Diagnostic(Cm): </h5>" . $row["diagnostic"];
        echo "<h5>Date et Heure: </h5>" . $row["la_date"] . "  " . $row["heure"];

    }
}
?>