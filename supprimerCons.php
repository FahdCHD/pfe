<?php
require_once ('connect.php');


if (isset($_POST['click_delete_button'])) {
    $id_cons = $_POST["user_id"];
    $requete = "DELETE FROM consultation WHERE NumeroConsultation='$id_cons'";

    if ($conn->query($requete)) {
        echo "data deleted successfully";
    } else {
        echo "error:" . $conn->error;
    }
}
?>