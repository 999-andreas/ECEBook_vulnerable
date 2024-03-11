<?php
require_once("../controller/database.php");

if (isset($_GET['email']) && isset($_GET['code'])) {
    //recupération de l'email et du code de verification
    $email = $_GET['email'];
    $code = $_GET['code'];

    $db = new Database();

    $user = $db->GetUserByEmailAndCode($email, $code);

    if ($user) {
        if (isset($user['confirmer']) && $user['confirmer'] == 0) {

            $db->ConfirmUser($email);
            echo '<div class="alert alert-success" role="alert">
            "Votre compte est maintenant confirmé. Vous pouvez vous connecter à ECEbook !"
          </div>';
            
            exit();
        } else {
            echo '<div class="alert alert-success" role="alert">
            "<script>alert("Votre compte est déjà confirmé.");</script>"
          </div>';
            
        }
    } else {
        echo "<script>alert('Le code de confirmation est incorrect.');</script>
        "; 
    }
} else {
    echo "<script>alert('Paramètres manquants.');</script>
    "; 
}
?>
