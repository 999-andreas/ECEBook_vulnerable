<?php 


require_once("../controller/database.php");


   // Récupération des paramètres de l'URL
        $id_post = intval($_GET['post_id']) ;
        $userID = intval($_GET["user_id"]) ;
        $type=intval($_GET["type"]);
        var_dump($id_post);
        var_dump($userID);

        // Ajout du like dans la base de données

	$db = new Database();
    $db->addLike($id_post,$userID,$type);

    
   // Redirection vers la page de profil

    header("location:../views/profile.php"); 





?>
