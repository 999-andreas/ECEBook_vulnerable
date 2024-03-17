<?php 


require_once("../controller/database.php");


   // Récupération de l'identifiant du post et de l'utilisateur depuis l'URL

        $id_post = intval($_GET['post_id']) ;
        $userID =intval($_GET["user_id"]);

        // Affichage des valeurs récupérées pour débogage
        var_dump($id_post);
        var_dump($userID);

        // Instanciation d'un objet de la classe Database pour ajouter l'annonce aux favoris de l'utilisateur

	$db = new Database();
    $db->addAnnonceToMyFavourites($userID,$id_post);
   
    header("location:../views/index2.php"); 

?>
