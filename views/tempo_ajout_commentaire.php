<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require("../controller/database.php");

$_POST['id_post'] = $_GET['id_post'];


$db = new Database();
$comments = $db->GetCommentByPostId($_GET['id_post']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>ajout de commentaire </title>
</head>
<body>
	<?php  require("../model/navbar.php") ?>

	<!--- \\\\\\\Post-->
	<?php foreach ($comments as $comment): ?>
                    <?php       

                    // Get user information
                    $user_id = $comment['id_user'];
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
                                        <div class="h5 m-0"><?=  $user["nom"] ?></div>
                                    </div>
                                </div>
                                <div>
                                
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
    <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i><?= $comment["time_stamp"]?></div>

    <p class="long-message preview-<?= $comment['id_post'] ?>">
    <?php
    $message = nl2br(htmlspecialchars($comment["contenu"]));
    $max_length = 200; // longueur maximale du message à afficher
    if (strlen($message) > $max_length) {
        $truncated_message = substr($message, 0, $max_length) . "...";
        echo '<span class="preview">' . $truncated_message . '</span>';
        echo '<span class="full" style="display: none;">' . $message . '</span>';
        echo '<button class="toggle-preview btn btn-link" type="button" data-target="#collapseExample-' . $comment['id_post'] . '">Voir plus</button>';
        echo '<button class="toggle-full btn btn-link" type="button" style="display: none;" data-target="#collapseExample-' . $comment['id_post'] . '">Voir moins</button>';
    } else {
        echo '<span class="preview">' . $message . '</span>';
    }
    ?>

	</p>
    </div>

              
	<?php endforeach ; ?>
	

	<form action="../model/addComment.php?id_post=<?php echo $_GET['id_post']?>" method="post">
		<label for="comment">ajouter un nouveau commentaire :</label><br>
		<textarea id="comment" name="comment" rows="5" cols="50"></textarea><br><br>
		<input type="submit" value="Envoyer">
	</form>
    <?=include("footer.php")?>
</body>
</html>


