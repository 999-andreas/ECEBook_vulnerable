<?php
session_start();
require("../controller/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST'&& $_POST['csrf_token'] == $_SESSION['csrf_token']) {
    //recupération des données saisies
    $user_id = $_SESSION["id_user"];
    $titre = $_POST['titre'];
    $pseudo = $_SESSION["pseudo"];

    $message = $_POST['message'];
    $date_creation=date('Y-m-d H:i:s');
    $imagePost = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];
    if(isset($_POST['publique']) && $_POST['publique'] == '1'){
        $publique = '1';
    } else {
        $publique = '0';
    }

    //on detecter les identificatio dans le poste 
    //et stock les pseudo dans un tableau
    $pattern = '/#(\w+)/';
    $matches = array();
    preg_match_all($pattern, $message, $matches);
    $names = $matches[1];

    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imagePost);
    if(strlen($message) > 500){
        echo "<script>alert('Erreur : le message dépasse la limite de 500 caractères.');</script>";
        header("location:../views/dashboard.php"); 
        exit();
    }


    $db = new Database();

    $db->insertPost($user_id, $titre, $pseudo, $message,$imagePost,$publique,$date_creation);


    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    if(empty($names)!=1)
    {
        $_SESSION['names'] = $names;
        $_SESSION['message_post'] = $message;
        $_SESSION['date_post'] = $date_creation;
        header("location:../model/envoie_mail_identification.php");
    }
    else
    {
        header("location:../views/dashboard.php");
    }

    
} else {
        // Display the errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    
}
?> 
