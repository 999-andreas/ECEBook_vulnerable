<?php
session_start();
require("../controller/database.php");

if (isset($_POST["submit"])) { // Vérifie si le formulaire a été soumis

    try {
        // Échappement des données pour la protection XSS avec htmlspecialchars
        $user_id = $_SESSION["id_user"]; 
        $titre = htmlspecialchars($_POST['titre'], ENT_QUOTES, 'UTF-8');
        $nom = $_SESSION["nom"]; 
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
        $date_creation = date('Y-m-d H:i:s'); 
        

        // Gestion de l'upload de l'image
        $imagePost = $_FILES['image']['name'];
        $filetmpname = $_FILES['image']['tmp_name'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Types de fichiers autorisés
        $fileType = mime_content_type($filetmpname);
        
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception('Type de fichier non autorisé.');
        }
        
        $maxSize = 2 * 1024 * 1024; // 2MB
        if ($_FILES['image']['size'] > $maxSize) {
            throw new Exception('Le fichier est trop volumineux.');
        }

        $extension = strtolower(pathinfo($imagePost, PATHINFO_EXTENSION));
        $newFileName = uniqid('post_', true) . '.' . $extension;
        $folder = '../uploads/';

        if (!move_uploaded_file($filetmpname, $folder . $newFileName)) {
            throw new Exception("Erreur lors du téléchargement de l'image.");
        }

        // Traitement de la visibilité du post
        $publique = isset($_POST['publique']) && $_POST['publique'] == '1' ? '1' : '0';

        // Détecte les identifications dans le post et stocke les pseudos dans un tableau
        $pattern = '/#(\w+)/';
        $matches = [];
        preg_match_all($pattern, $message, $matches);
        $names = $matches[1];

        // Sauvegarde des données du formulaire dans la base de données
        $db = new Database();
        $db->insertPost($user_id, $titre, $nom, $message, $newFileName, $publique, $date_creation);

        // Redirection en fonction de la présence d'identifications
        if (!empty($names)) {
            $_SESSION['names'] = $names;
            $_SESSION['message_post'] = $message;
            $_SESSION['date_post'] = $date_creation;
            header("location:../model/envoie_mail_identification.php");
        } else {
            header("location:../views/index2.php");
        }

    } catch (Exception $e) {
        echo "Erreur lors de l'ajout du post : " . $e->getMessage();
        die();
    }
}
?>
