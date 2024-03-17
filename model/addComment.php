<?php
/*quand on clique sur envoyé le commentaire ca renvoie vers ici
et ca le mets dans la base de données des commentaires 
puis ca renvoie vers la page d'acceuil, avec l'affichage des commentaire updaté*/


// Vérifie si la session est active, sinon démarre une session

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");

// Récupère l'ID du post et de l'utilisateur depuis l'URL et le commentaire depuis le formulaire
$id_post = $_GET['id_post'];
$id_user = $_SESSION['id_user'];
$commentaire = $_POST['comment'];

// Initialise une instance de la classe Database pour ajouter le commentaire à la base de données
$db = new Database();
$db->AddComment($id_user, $id_post, $commentaire);
//$comments = $db->GetCommentByPostId($_GET['id_post']);
// sert à rien cette ligne ?


// Redirige vers la page d'accueil une fois le commentaire ajouté
header("location: ../views/index2.php");

?>


