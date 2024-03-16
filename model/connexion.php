<?php
error_reporting(E_ERROR | E_PARSE);

session_start();
require_once("../controller/database.php");

if(isset($_POST["submit"])){
    $email = htmlspecialchars($_POST["mail"] ?? '');
    $password = htmlspecialchars($_POST["password"] ?? '');
    
    try {
        $db = new Database();
        $user = $db->Login($email, $password);
        if($user ) { // check if user exists and password is correct
           
            //Verification du role
            if($user["roll"] == "admin"){
                //recupération des données admins
                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["admin"] = true;
                $_SESSION["pseudo"] = $user["pseudo"];
                header("location: ../views/dashboard.php");
            }
            else{
                if($user["confirmer"] == 1){

                    //recupération des données
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['email'] = $user['adressemail'];
                    $_SESSION['role'] = $user['roll'];
                    $_SESSION['promo'] = $user['promo'];
                    $_SESSION['image'] = $user['image'];
                    $_SESSION['description'] = $user['description'];
                    $_SESSION['logged_in'] = true;
                    header("location: ../views/profile.php");
                    
                    exit();
                }
                else{
                    echo "votre compte n'est pas encore verifé";
                    
                    header("location: ../views/connexion.php");
                    exit();
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Utilisateur non trouvé ou mot de passe incorrect
          </div>';
            /* var_dump($password); */
        }
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion: " . $e->getMessage();
        die();
    }
}
?>
