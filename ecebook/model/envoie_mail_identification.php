<?php

/* envoie de notification pour les identifications dans les postes (utilisateur/admin) s*/
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");
require("../model/navbar.php");

require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require_once("../vendor/phpmailer/phpmailer/src/SMTP.php");
require_once("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

/* on réupère les pseudo détecté dans le poste */
$names =  $_SESSION['names'];
$message = $_SESSION['message_post'];
$date_creation = $_SESSION['date_post'];

/* envoie de mail a chacun utilisateur identifié*/
foreach($names as $name)
{

    $db = new Database();
    $receveur = $db->GetUserByPseudo($name);

    if(!$receveur)
    {
        echo "<br>$name n'existe pas sur ECEbook";
        continue;
    }

    $email = htmlspecialchars($receveur["adressemail"]);
    $id_user = $_SESSION['id_user'];
    $mailenvoyeur = htmlspecialchars($_SESSION["email"]);

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
    $mail->Password = "stvglmepzmuwgqtd";
    //Email subject
    $mail->Subject = 'Confirmation de votre compte EceBook';
    
    //Set sender email
    $mail->setFrom('bookece484@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    //Attachment

    //Email body
    $mail->Body    = "Bonjour $email,<br><br>
    $mailenvoyeur vous a identifié dans le post suivant :<br>
    ' $message '<br>
    (mise en ligne du poste le : $date_creation)<br><br>
    Cordialement,<br>
    L'équipe EceBook";
    //Add recipient
    $mail->addAddress($email);
    //Finally send email
    if ( $mail->send() ) {
        echo "<br>le mail a été envoyé a $email";
    }else{
        echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
        var_dump($email);
        var_dump($verification_code );
        var_dump($mail->send());
    }
    //Closing smtp connection
    $mail->smtpClose();

    
}
?>

<?php if($_SESSION["admin"]) :?>
<script>
		// Attendre une seconde avant de rediriger l'admin
		setTimeout(function() {
            window.location.href = "../views/dashboard.php";
		}, 2000);
</script>

<?php else : ?>
    <script>
		// Attendre une seconde avant de rediriger l'utilisateur
		setTimeout(function() {
            window.location.href = "../views/index2.php";
		}, 2000);
</script>
<?php endif;?>