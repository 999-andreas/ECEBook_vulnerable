<?php
session_start();
require("../controller/database.php");

if(isset($_POST["submit"])){ // Vérifie si le formulaire a été soumis


    try{
        //recupération des données saisies
        $user_id = $_SESSION["id_user"]; // ID de l'utilisateur connecté
        $titre = $_POST['titre']; // Titre du post, aucune protection xss ici
        $nom = $_SESSION["nom"]; // Nom de l'utilisateur connecté
        $message = $_POST['message']; // Contenu du post
        $date_creation = date('Y-m-d H:i:s'); // Date de création du post
        $imagePost = $_FILES['image']['name']; // Nom de l'image du post
        $filetmpname = $_FILES['image']['tmp_name']; // Emplacement temporaire de l'image
        if(isset($_POST['publique']) && $_POST['publique'] == '1'){  // Vérifie si le post doit être public
            $publique = '1';
        } else {
            $publique = '0';
        }

            // On détecte les identifications dans le post et stocke les pseudos dans un tableau
        $pattern = '/#(\w+)/';
        $matches = array();
        preg_match_all($pattern, $message, $matches);
        $names = $matches[1];

    
        $folder = '../uploads/';
        move_uploaded_file($filetmpname, $folder . $imagePost); // aucune verification du fichier uploadé
        

                // Sauvegarde des données du formulaire dans la base de données
        $db = new Database();
        $db->insertPost($user_id, $titre, $nom, $message, $imagePost, $publique, $date_creation);
            // Si le tableau contenant les pseudos n'est pas vide, on stocke les informations dans la session et on redirige vers le script d'envoi de mail
        if(empty($names)!=1)
        {
            $_SESSION['names'] = $names;
            $_SESSION['message_post'] = $message;
            $_SESSION['date_post'] = $date_creation;
            header("location:../model/envoie_mail_identification.php");
        }
        else
        {
            header("location:../views/index2.php");
        }
    
    }catch(PDOException $e) {
        echo "Error adding post: " . $e->getMessage();
        die();
    }


}
?>
