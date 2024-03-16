<?php
require_once("../controller/database.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if(isset($_POST["submit"])){
//recupération des données
    $errors = [];

    $nomUser = $_POST["nom"] ?? '';
    $prenomUser = $_POST["prenom"] ?? '';
    $naissanceUser = $_POST["naissance"] ?? '';
    $villeUser = $_POST["ville"] ?? '';
    
    $promo = array($_POST["choixPromo"] ?? '');
    $promoUser = implode(",", $_POST["choixPromo"] ?? []);
    $usernameUser = $_POST["username"] ?? '';
    $emailUser = filter_var($_POST["email"] ?? '', FILTER_VALIDATE_EMAIL);
    $mdpUser = $_POST["motdepasse"]; // Hash the password // a enlever et tout les trucs lié au hash
    $descriptionUser = $_POST["description"] ?? '';
    $imageUser = $_FILES['image']['name'];
    $filetmpname = $_FILES['image']['tmp_name'];

    // Check if email is valid and from a valid domain
    if (!$emailUser) {
        $errors[] = "L'adresse e-mail n'est pas valide";
    } else {
        $validDomains = ['edu.ece.fr', 'omnes.intervenant.fr', 'admin.fr'];
        $domain = substr(strrchr($emailUser, "@"), 1);
        if (!in_array($domain, $validDomains)) {
            $errors[] = "L'adresse e-mail doit être de domaine edu.ece.fr, omnes.intervenant.fr ou admin.fr";
        }
        elseif($domain === "edu.ece.fr"){
            $roleUser = "etudiant";
        }
        elseif($domain === "omnes.intervenant.fr"){
            $roleUser = "professeur";
        }
        elseif($domain === "admin.fr"){
            $roleUser = "admin";
        }
    }



     // vérifie si l'adresse e-mail existe déjà
     $db = new Database();
     $emailList = $db->getAllEmails();
     if (in_array($emailUser, $emailList)){
         $errors[] = "Cette adresse e-mail est déjà utilisée";
     }
     


    $code_confirmation = uniqid();



    
    $db = new Database();
    
    $folder = '../uploads/';
    move_uploaded_file($filetmpname, $folder . $imageUser);


     // Check if there are any errors
     if (count($errors) == 0) {


    $db->AddUser($nomUser, $prenomUser, $naissanceUser, $villeUser, $promoUser, $roleUser, $usernameUser, $emailUser, $mdpUser, $descriptionUser, $imageUser, $code_confirmation);
    


   /*
$mail = new PHPMailer(true);
//Set mailer to use smtp
$mail->isSMTP();
//Define smtp host
$mail->Host = 'smtp.gmail.com';
$mail->SMTPDebug = 1;
//Enable smtp authentication
$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
$mail->SMTPSecure = "ssl";
//Port to connect smtp
$mail->Port = 465;  
//Set Hotmail username
$mail->Username = "bookece484@gmail.com";
//Set Hotmail password
$mail->Password = "stvglmepzmuwgqtd"; //hardcoded password letsgo
//Email subject
$mail->Subject = 'Confirmation de votre compte EceBook';

//Set sender email
$mail->setFrom('bookece484@gmail.com');
//Enable HTML
$mail->isHTML(true);

//Email body
$mail->Body    = "Bonjour $usernameUser,<br><br>
Veuillez cliquer sur le lien suivant pour confirmer votre compte EceBook:<br>
<a href='http://localhost/ECEbook/model/confirmation.php?email=$emailUser&code=$code_confirmation'>http://localhost/ECEbook/model/confirmation.php?email=$emailUser&code=$code_confirmation</a><br><br>
Cordialement,<br>
L'équipe EceBook";
//Add recipient
$mail->addAddress($emailUser);
//Finally send email
if ($mail->send()) {
    echo "Email Sent..!";
} else {
    echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    var_dump($emailUser);
    var_dump($code_confirmation);
}
//Closing smtp connection
$mail->smtpClose();





    if($domain === "admin.fr" ) {
        header("location: ../views/dashboard.php");
        exit();
    } else {
        header("location: ../views/connexion.php");
        exit();
    } */

    header("location: ../views/connexion.php");
    exit();

   
    } else {
        // Display the errors
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }
}
?>
