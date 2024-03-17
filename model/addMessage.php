<?php
/*ici l'envoie d'un nouveau message vers la bdd */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");

$id_user1 = $_SESSION["id_user"];
$id_user2 = $_GET["id_receveur"];

$contenu = $_POST["contenu"];

$db = new Database();
$db->addMessage($id_user1, $id_user2, $contenu);

header("location: ../views/messagerie.php");

?>