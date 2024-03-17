<?php

/* partie dynamique de l'affichage de la messagerie */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
}
require("../controller/database.php");

if(isset($_POST['page']) && $_POST['page']!= '0') {

    /* on affiche la conversation de l'utilisateur selectionné */
	$page = $_POST['page'];

    $db = new Database();
    $messages = $db->getMessageByUserId($_SESSION["id_user"], $page);?>

    <html>
    <?php foreach ($messages as $message): ?>
            <?php       
            // Get user information
            $user_id = $message["expediteur_id"];
            $user = $db->getUserById($user_id);
            ?>

            <div class="card gedf-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">

                            <?php if($user["image"] != null) : ?>
                                    <img class="rounded-circle" width="45"
                                     src="../uploads/<?= $user["image"]  ?>" alt="">
                            <?php elseif ($user["image"] == null) : ?>
                                    <img class="rounded-circle" width="45"
                                    src="../uploads/avatar.png" alt="">
                            <?php endif ; ?>
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0"><?=  $user["pseudo"] ?></div>
                            </div>
                        </div>
                        <div>
                        
                        </div>
                    </div>

                </div>
                <div class="card-body">
                <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i><?= $message["date_envoi"]?></div>
                <a class="card-link" href="#">
                    <h5 class="card-title"><?= $message["contenu"] ?></h5>
                </a>
            </div>
            
        <?php endforeach ; ?>
    
        <form action="../model/addMessage.php?id_receveur=<?php echo $page?>" method="post">
            <label for="comment">nouveau message :</label><br>
            <textarea id="contenu" name="contenu" rows="5" cols="50"></textarea><br><br>
            <input type="submit" value="Envoyer">
        </form>
    </html>

<?php } 
else {?>

<html>
<p>Sélectionnez un conversation.<br>
(vous pouvez parler avec toutes les personnes à qui vous êtes abonné ou qui sont abonné à vous)
</p>
</html>

<?php }?>