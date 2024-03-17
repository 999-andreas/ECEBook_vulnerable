<?php

/* ici on enlève un abonnement de la bdd */
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");
require("../model/navbar.php");

    
    
$id_user1 = $_SESSION['id_user'];
$id_user2 = $_GET['id_abonné'];


//suppression des abonnements
$db = new Database();
$db->deleteSubscriber($id_user1, $id_user2);

echo "Vous êtes maintenant desabonné !";

?>

<script>
		// Attendre une seconde avant de rediriger l'utilisateur
		setTimeout(function() {
			window.location.href = "../views/index2.php";
		}, 2000);
</script>