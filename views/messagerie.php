<?php
/*ici le front de la messagerie, tout les conversations de l'utilisateur avec ses abonnés et abonnement*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
}

require("../controller/database.php");

$db = new Database();
$abonnes = $db->getALLSubs($_SESSION["id_user"]);

$uniqueIds = array();

/* on créé une liste de tout les utilisateur unique avec qui l'utilisateur peut parler */
foreach ($abonnes as $key =>$abonne) {

    if($_SESSION["id_user"] == $abonne["user1_id"]){
        if(in_array($abonne['user2_id'], $uniqueIds))
        {
            unset($abonnes[$key]);
        }
        else
        {
            $uniqueIds[] = $abonne['user2_id'];
        }
    }else{
        if(in_array($abonne['user1_id'], $uniqueIds))
        {
            unset($abonnes[$key]);
        }
        else
        {
            $uniqueIds[] = $abonne['user1_id'];
        }
    }
  }
  
require("../model/navbar.php"); 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Messagerie : </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#page-select').change(function() {
				var page = $(this).val();
				$.ajax({
					type: 'POST',
					url: 'AJAX_messagerie.php',
					data: { page: page },
					success: function(response) {
						$('#content').html(response);
					}
				});
			});
		});
	</script>
</head>
<body>
	<h1>Messagerie</h1>
	<select id="page-select">
        <option value="0">Choisissez une conversation</option>
        <?php foreach ($uniqueIds as $abonne): ?> <!--- il faut prendre les gens a qui tu es abonné et les gens qui sont abonné à toi-->
		    
            <?php $user = $db->getUserById($abonne); ?>
            <option value=<?php echo $user["id_user"]?>><?php echo $user["nom"]." ".$user["prenom"]."-".$user["id_user"]?></option>
        
        <?php endforeach ; ?>
	</select>

	<div id="content">
		<p>Sélectionnez un conversation.<br>
        (vous pouvez parler avec toutes les personnes à qui vous êtes abonné ou qui sont abonné à vous)
        </p>
	</div>
</body>
</html>
