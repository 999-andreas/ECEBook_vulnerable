<?php

/* on enregistre un nouveau abonnement dans la bdd */

require("../controller/database.php");
    
    
    $id_user1 = intval($_GET["id_user"]);
    $id_user2 = intval($_GET['id_abonne']);
    $code = $_GET['code'];

    var_dump($id_user1);
    var_dump($id_user2);
    $db = new Database();
    $receveur = $db->GetUserById($id_user2);

    /* on verifie si le code fournis correspond au code de confirmation */
    if($receveur['code_confirmation']== $code)
    {
        echo '<div class="alert alert-success" role="alert">
        <script>alert("vous avez accépter la demande d abonnement, vous pouvez fermer cette page");</script>
      </div>
        ';
        $db->addSubcriber($id_user1, $id_user2);
    }
    else
    {
        echo '
        <div class="alert alert-danger" role="alert">
        <script>alert("mauvais code de confirmation, vous pouvez fermer cette page");</script>
          </div>
        ';
    }

    //on remet le code à 0 à la fin de chaque utilisation 
    $db->updateVericiationCodeByEmail($receveur['adressemail'],"");

?>
<script>
		// Attendre une seconde avant de rediriger l'utilisateur
		setTimeout(function() {
			window.location.href = "../views/connexion.php";
		}, 2000);
</script>

