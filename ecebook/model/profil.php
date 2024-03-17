<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../controller/database.php");
if(!isset($_SESSION["id_user"])){
    header("Location:../views/connexion.php");
    exit();
} else {
    $db = new Database();
    $user_id = $_SESSION['id_user'];
    $user = $db->GetUserById($_SESSION["id_user"]);
    
    $nb_abonnement = count($db->getSubsByUser2Id($_SESSION["id_user"]));
    $nb_abonné = count($db->getSubsByUser1Id($_SESSION["id_user"]));
    $nb_post=count($db->getAllPostsByIduser($_SESSION["id_user"]));
    

}
?>