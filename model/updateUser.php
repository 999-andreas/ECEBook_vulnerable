<?php 


require("../controller/database.php");
session_start();


if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
    exit();
}



$db = new Database();
$user = $db->GetUserById($_SESSION["id_user"]);


if(isset($_POST["submit"])){
    if($_POST['csrf_token'] == $_SESSION['csrf_token']){
    //recupération de tous les champs saisie par l'utilisateur
    $user_id = $_SESSION["id_user"];
    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    
    $promo = $_POST["choixPromo"] ?? [];
    $promoUser = implode(",",$promo);
    
    $usernameUser = $_POST["pseudo"] ?? '';
    $descriptionUser = $_POST["description"] ?? '';
    $emailUser = $_POST["email"] ?? '';
    $confirmerUser = $_POST["confirmer"] ?? '';
    $mdpUser= $_POST["motdepasse"];  //j'ai enlever le hash ici
    $imageUser = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imageUser);
    $db->updateUserByIdUser($user_id, $nomUser,$prenomUser,$naissanceUser,$villeUser,$usernameUser,$mdpUser,$descriptionUser,$emailUser, $promoUser, $imageUser,);
    

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header("location: ../views/profile.php");

    }
    else{
        die("Erreur CSRF : Jeton CSRF invalide.");
    }
}

?>