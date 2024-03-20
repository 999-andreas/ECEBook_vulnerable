<?php 


require_once("../controller/database.php");


   //recupération des données // par get ?? wtf
    $id_post = intval($_GET['post_id']) ;
    $userID = intval($_GET["user_id"]) ;
	$db = new Database();
    $db->deletePostByIdUserAndIdpost($userID, $id_post);
   
    header("location:../views/profile.php"); 





?>
