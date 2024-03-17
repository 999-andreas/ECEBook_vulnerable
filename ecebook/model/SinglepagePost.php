<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require("../controller/database.php");
if(!isset($_SESSION["id_user"])){
    header("Location:../views/connexion.php");
    exit();
} else {
    $db = new Database();
    $id_post = intval($_GET['post_id']) ;
    $userID = intval($_GET["user_id"]) ;
    $user = $db->GetUserById($userID);
    $post = $db->GetPostById($id_post);
    
    

}
?>