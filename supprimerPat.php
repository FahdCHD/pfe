<?php
require_once ('connect.php');


if (isset($_POST['click_delete_button'])) {
    $id_pat = $_POST["user_id"];
    $requete = "DELETE FROM patient WHERE id_patient='$id_pat'";

    if ($conn->query($requete)) {
        echo "data deleted successfully";
    } else {
        echo "error:" . $conn->error;
    }
}
?>