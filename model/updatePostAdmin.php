<?php 

session_start();

require("../controller/database.php");

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}

$db = new Database();

try {
    if(isset($_POST["submit"])){//recupération de tous les champs saisies
        $post_id = $_GET["post_id"];
        $titreP = $_POST["titre"] ?? '';
        $messageP = $_POST["message"] ?? '';
       
        $imagePost = $_FILES['image']['name'];
        $filetmpname = $_FILES['image']['tmp_name'];
        $publique = $_POST["publique"];


        $folder = '../uploads/';
        move_uploaded_file($filetmpname, $folder . $imagePost);
        if(strlen($message) > 500){

            echo "<script>alert('Erreur : le message dépasse la limite de 500 caractères.');</script>";
            header("location:../views/dashboard.php"); 
            exit();
        }

        $db->updatePostById($post_id,$titreP,$messageP,$imagePost,$publique);
    
        header("location: ../views/dashboard.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
