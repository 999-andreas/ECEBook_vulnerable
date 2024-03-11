<?php
require_once("../controller/database.php");

if (isset($_GET['email']) ) {


   // Vérifier le code de confirmation
    $email = $_GET["email"] ?? '';
    $code = $_GET["code"] ?? '';
    if (!empty($email) && !empty($code)) {
        if ($db->VerifyConfirmationCode($email, $code)) {
            header("location: ../views/resepassword.php?email=$email&code=$code");
        } else {
            // Le code de confirmation n'est pas valide, afficher un message d'erreur
        }
    } else {
        // L'e-mail ou le code de confirmation est manquant, afficher un message d'erreur
    }

//     $email = $_GET['email'];


//     $db = new Database();

//     $user = $db->GetUserByEmailAndCode($email, $code);

//     if ($user) {
//         if (isset($user['confirmer']) && $user['confirmer'] == 0) {

//             $db->ConfirmUser($email);
//             echo "Votre compte est maintenant confirmé. Vous pouvez vous connecter à ECEbook !";
            
//             exit();
//         } else {
//             echo "Votre compte est déjà confirmé.";
//         }
//     } else {
//         echo "Le code de confirmation est incorrect.";
//     }
// } else {
//     echo "Paramètres manquants.";
}
?>
