<?php
error_reporting(E_ERROR | E_PARSE);

session_start();
require_once("../controller/database.php");

if(isset($_POST["submit"])){
    $email = htmlspecialchars($_POST["mail"] ?? '');
    $password = htmlspecialchars($_POST["password"] ?? '');
    
    //empeche bruteforce
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['login_timestamp'] = 0;
    }

    
    $current_time = time();
    if ($_SESSION['login_attempts'] > 3 && $current_time - $_SESSION['login_timestamp'] < 1 * 60) {
        
        echo 'Vous avez atteint le nombre maximum de tentatives de connexion. Veuillez réessayer plus tard.';
        exit;
    }

    try {
        $db = new Database();
        $user = $db->Login($email, $password);
        if($user) {
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;
            $_SESSION['login_timestamp'] = 0;

            // Verification du role
            if($user["role"] == "admin"){ 
                // Recuperation des donnees admin
                $_SESSION["id_user"] = $user["id_user"];
                $_SESSION["admin"] = true;
                $_SESSION["pseudo"] = $user["pseudo"];
                header("location: ../views/dashboard.php");
                exit;
            } else {
                if($user["confirmer"] == 1){
                    // Recuperation des donnees utilisateur
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['email'] = $user['adressemail']; 
                    $_SESSION['role'] = $user['role']; 
                    $_SESSION['promo'] = $user['promo'];
                    $_SESSION['image'] = $user['image'];
                    $_SESSION['description'] = $user['description'];
                    $_SESSION['logged_in'] = true;
                    header("location: ../views/profile.php");
                    exit;
                } else {
                    echo "Votre compte n'est pas encore verifié.";
                    exit;
                }
            }
        } else {
            // Increase login attempts on failure
            $_SESSION['login_attempts']++;
            $_SESSION['login_timestamp'] = time();
            echo '<div class="alert alert-danger" role="alert">
            Utilisateur non trouvé ou mot de passe incorrect.
          </div>';
        }
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion: " . $e->getMessage();
        die();
    }
}
?>
