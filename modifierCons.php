<?php
include "connect.php";

// if (isset($_POST["click_edit_button"])) {
//     $id_cons = $_POST["user_id"];
//     $arrayresult = [];
//     $sql = "SELECT * FROM consultation WHERE NumeroConsultation = '$id_cons'";

//     $resultP = $conn->query($sql);
//     if (!$resultP) {
//         echo "error" . $conn->error;
//     }
//     while ($row = $resultP->fetch_assoc()) {
//         array_push($arrayresult, $row);
//         header("content-type: application/json");
//         echo json_encode($arrayresult);
//     }
// }
if (isset($_POST["enregistrer_update"])) {

    $nom = $_POST["choisir_patient"];
    $NumeroCons = $_POST["numconsultation"];
    $situation = $_POST["choisir_situation"];
    $motif = $_POST["motif"];
    $antecedent = $_POST["antecedent"];
    $examen_clinique = $_POST["examen_clinique"];
    $examen_biologique = $_POST["examen_biologique"];
    $examen_radiologique = $_POST["examen_radiologique"];
    $diagnostic = $_POST["diagnostic"];
    $la_date = $_POST["la_date"];
    $heure = $_POST["hour"];


    if (empty($la_date)) {
        $la_date = null;
    }
    if (empty($heure)) {
        $heure = null;
    }

    $sql = "UPDATE consultation SET nom_prenom_patient = '$nom', NumeroConsultation = '$NumeroCons', situation = '$situation', motif = '$motif', antecedent = '$antecedent', examen_clinique = '$examen_clinique', examen_biologique = '$examen_biologique', examen_radiologique = '$examen_radiologique', diagnostic = '$diagnostic', la_date = '$la_date', heure = '$heure' WHERE NumeroConsultation = '$NumeroCons'";
    if (!$conn->query($sql)) {
        echo "error" . $conn->error;
    }
    header('Location: consultation.php');
}



// if (isset($_POST['updatedata'])) {
//     $nom = $_POST["choisir_patient"];
//     $NumeroCons = $_POST["numconsultation"];
//     $situation = $_POST["choisir_situation"];
//     $motif = $_POST["motif"];
//     $antecedent = $_POST["antecedent"];
//     $examen_clinique = $_POST["examen_clinique"];
//     $examen_biologique = $_POST["examen_biologique"];
//     $examen_radiologique = $_POST["examen_radiologique"];
//     $diagnostic = $_POST["diagnostic"];
//     $la_date = $_POST["la_date"];
//     $heure = $_POST["hour"];

//     $query = "UPDATE consultation SET nom_prenom_patient = '$nom', NumeroConsultation = '$NumeroCons', situation = '$situation', motif = '$motif', antecedent = '$antecedent', examen_clinique = '$examen_clinique', examen_biologique = '$examen_biologique', examen_radiologique = '$examen_radiologique', diagnostic = '$diagnostic', la_date = '$la_date', heure = '$heure' WHERE NumeroConsultation = '$NumeroCons'";

//     $query_run = mysqli_query($conn, $query);

//     if ($query_run) {
//         echo '<script> alert("Data Updated"); </script>';
//         header("Location:consultation.php");
//     } else {
//         echo '<script> alert("Data Not Updated"); </script>';
//     }
// }

?>