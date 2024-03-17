<?php
require_once("../controller/database.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST["submit"])) {
    $errors = [];

    $nomUser = htmlspecialchars($_POST["nom"] ?? '', ENT_QUOTES, 'UTF-8');
    $prenomUser = htmlspecialchars($_POST["prenom"] ?? '', ENT_QUOTES, 'UTF-8');
    $naissanceUser = htmlspecialchars($_POST["naissance"] ?? '', ENT_QUOTES, 'UTF-8');
    $villeUser = htmlspecialchars($_POST["ville"] ?? '', ENT_QUOTES, 'UTF-8');
    $promoUser = isset($_POST["choixPromo"]) ? htmlspecialchars(implode(",", $_POST["choixPromo"]), ENT_QUOTES, 'UTF-8') : '';
    $usernameUser = htmlspecialchars($_POST["username"] ?? '', ENT_QUOTES, 'UTF-8');
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT);
    $descriptionUser = htmlspecialchars($_POST["description"] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUser = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
    $filetmpname = !empty($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : null;

    if (!$emailUser) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    } else {
        $domain = substr(strrchr($emailUser, "@"), 1);
        if ($domain === "admin.fr") {
            $errors[] = "L'inscription avec une adresse email du domaine admin.fr n'est pas autorisée.";
        }
    }

    if (empty($imageUser)) {
        $newFileName = null;
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['image']['type'];
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Type de fichier non autorisé.';
        } else {
            $maxSize = 2 * 1024 * 1024; // 2MB
            if ($_FILES['image']['size'] > $maxSize) {
                $errors[] = 'Le fichier est trop volumineux.';
            } else {
                $extension = pathinfo($imageUser, PATHINFO_EXTENSION);
                $newFileName = uniqid('', true) . '.' . $extension;
                $folder = '../uploads/';
                if (!move_uploaded_file($filetmpname, $folder . $newFileName)) {
                    $errors[] = "Erreur lors du téléchargement de l'image.";
                }
            }
        }
    }

    if (count($errors) == 0) {
        $db = new Database();
        $roleUser = ($domain === "edu.ece.fr") ? "etudiant" : (($domain === "omnes.intervenant.fr") ? "professeur" : "user");
        $code_confirmation = uniqid();
        $db->AddUser($nomUser, $prenomUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser, $newFileName, $code_confirmation);
        header("location: ../views/connexion.php");
        exit();
    } else {
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
        }
    }
}
?>
