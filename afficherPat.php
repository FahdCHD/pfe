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
        echo "<b>Nom et Prenom: </b>" . $row["nom_prenom_patient"] . "<br>";
        echo "<b>Sexe: </b>" . $row["sexe_patient"] . "<br>";
        echo "<b>Age: </b>" . $row["age_patient"] . "<br>";
        echo "<b>Ville: </b>" . $row["ville_patient"] . "<br>";
        echo "<b>Mobile: </b>" . $row["mobile_patient"] . "<br>";
        echo "<b>Profession: </b>" . $row["profession"] . "<br>";
        echo "<b>Situation: </b>" . $row["situation"] . "<br>";
        echo "<b>Poids: </b>" . $row["poids"] . "kg<br>";
        echo "<b>Taille: </b>" . $row["taille"] . "cm<br>";
        echo "<b>Date: </b>" . $row["la_date"] . "<br>";

    }
}
?>