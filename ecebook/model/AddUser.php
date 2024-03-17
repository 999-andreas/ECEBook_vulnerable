<?php

require("../controller/database.php");

if (isset($_POST["submit"])) {
    $errors = [];
    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    $promo = $_POST["choixPromo"] ?? [];
    $promoUser = implode(",", $promo);
    $usernameUser = $_POST["username"] ?? '';
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = password_hash($_POST["motdepasse"], PASSWORD_DEFAULT);
    $descriptionUser = $_POST["description"] ?? '';
    $imageUser = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    $folder = '../uploads/';
    $roleUser = ''; // Initialise le rôle de l'utilisateur

    if (!$emailUser) {
        $errors[] = "L'adresse e-mail n'est pas valide";
    } else {
        $validDomains = ['edu.ece.fr', 'omnes.intervenant.fr'];
        $domain = substr(strrchr($emailUser, "@"), 1);
        if (!in_array($domain, $validDomains)) {
            $errors[] = "L'adresse e-mail doit appartenir à l'un des domaines suivants : edu.ece.fr, omnes.intervenant.fr";
        } else {
            if ($domain === "edu.ece.fr") {
                $roleUser = "etudiant";
            } elseif ($domain === "omnes.intervenant.fr") {
                $roleUser = "professeur";
            }
        }
    }

    if (empty($roleUser)) {
        $errors[] = "Le domaine de l'adresse e-mail n'est pas autorisé à créer un compte.";
    }

    $db = new Database();

    if (in_array($emailUser, $db->getAllEmails())) {
        $errors[] = "Cette adresse e-mail est déjà utilisée";
    }

    $code_confirmation = uniqid();

    if (!empty($imageUser)) {
        if (!move_uploaded_file($filetmpname, $folder . $imageUser)) {
            $errors[] = "Erreur lors du téléchargement de l'image.";
        }
    }

    if (count($errors) == 0) {
        $db->AddUser($nomUser, $prenomUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser, $imageUser, $code_confirmation);
        header("location: ../views/dashboard.php");
        exit();
    } else {
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
        }
    }
}
?>
