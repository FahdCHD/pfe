<?php
include "connect.php";
if (isset($_POST["emp_id"])) {
    $output = '';

    $id_emp = $_POST["emp_id"];
    $query = "SELECT * FROM consultation WHERE NumeroConsultation  = '$id_emp'";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_array($result)) {

        echo "<b>Nom et Prenom: </b>" . $row["nom_prenom_patient"] . "<br>";
        echo "<b>Numéro de consultation: </b>" . $row["NumeroConsultation"] . "<br>";
        echo "<b>Situation: </b>" . $row["situation"] . "<br>";
        echo "<b>Motif: </b>" . $row["motif"] . "<br>";
        echo "<b>Antécedent: </b>" . $row["antecedent"] . "<br>";
        echo "<b>Examen clinique: </b>" . $row["examen_clinique"] . "<br>";
        echo "<b>Examen biologique: </b>" . $row["examen_biologique"] . "<br>";
        echo "<b>Examen radiologique: </b>" . $row["examen_radiologique"] . "<br>";
        echo "<b>Diagnostic: </b>" . $row["diagnostic"] . "<br>";
        echo "<b>Date: </b>" . $row["la_date"] . "<br>";
        echo "<b>Heure: </b>" . $row["heure"] . "<br>";

    }
    //         $output .= '  
//               <tr>  
//                    <td width="30%"><label>Nom</label></td>  
//                    <td width="70%">' . $row["nom_prenom_patient"] . '</td>  
//               </tr>  
//               <tr>  
//                    <td width="30%"><label>Numéro de consultation</label></td>  
//                    <td width="70%">' . $row["NumeroConsultation"] . '</td>  
//               </tr> 
//               <tr>  
//               <td width="30%"><label>Situation</label></td>  
//               <td width="70%">' . $row["situation"] . '</td>  
//          </tr>  
//          <tr>  
//          <td width="30%"><label>Motif</label></td>  
//          <td width="70%">' . $row["motif"] . '</td>  
//     </tr>  
//     <tr>  
//     <td width="30%"><label>Antécedent</label></td>  
//     <td width="70%">' . $row["antecedent"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Examen Clinique</label></td>  
// <td width="70%">' . $row["examen_clinique"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Examen Biologique</label></td>  
// <td width="70%">' . $row["examen_biologique"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Examen Radiologique</label></td>  
// <td width="70%">' . $row["examen_radiologique"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Diagnostic</label></td>  
// <td width="70%">' . $row["diagnostic"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Date</label></td>  
// <td width="70%">' . $row["la_date"] . '</td>  
// </tr>  
// <tr>  
// <td width="30%"><label>Heure</label></td>  
// <td width="70%">' . $row["heure"] . '</td>  
// </tr>   
//               ';
//     }
//     $output .= "</table></div>";
//     echo $output;








}