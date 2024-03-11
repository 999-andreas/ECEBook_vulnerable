<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require_once("../model/profil.php");

//Afichage des informations, posts et gestion du compte de l'user connécté

// require("../controller/database.php");
$db = new Database();
$posts= $db->getAllPostsByIduser($_SESSION["id_user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <title>Profil</title>
</head>
<body>
    <?php require("../model/navbar.php") ?>
<div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel ">
          <div class="user-heading round">
              <a href="#">
              <?php 
					if($user["image"] != null) : ?>
						<img src="../uploads/<?=  $user["image"] ?>"  class="d-block ui-w-100 rounded-circle" />
                    <?php elseif ($user["image"] == null) : ?>
						<img src="../uploads/avatar.png"  class="d-block ui-w-100 rounded-circle"/>
                <?php endif ; ?>
              </a>
              <h1><?=  $user["nom"] . " " . $user["prenom"] ?></h1>
              <p><?=  $user["adressemail"] ?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
              <li><a href="../views/updateUser.php"> <i class="fa fa-edit"></i> modifier profile</a></li>
              <li><a href="../model/deleteUser.php"> <i class="fa fa-edit"></i> supprimer le profil</a></li>
              <li><a href="#"> <i class="fa fa-edit"></i> nombre d'abonné : <?php echo $nb_abonnement ?></a></li>
              <li><a href="#"> <i class="fa fa-edit"></i> nombre d'abonnement : <?php echo $nb_abonné ?></a></li>
              <li><a href="#"> <i class="fa fa-edit"></i> nombre de post : <?php echo $nb_post ?></a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">

        <div class="panel card ">
            <div class="bio-graph-heading">
                <?=  $user["description"] ?>
            </div>
            <div class="panel-body bio-graph-info">
                <h1>Profile informations </h1>
                <div class="row">
                    <div class="bio-row">
                        <p><span>Nom </span>: <?= $user["nom"]  ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>prenom </span>: <?=  $user["prenom"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>ville </span>: <?= $user["ville"]  ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Mail</span>: <?= $user["adressemail"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>role </span>: <?=  $user["roll"] ?> </p>
                    </div>
                    <div class="bio-row">
                        <p><span>promo </span>: <?=  $user["promo"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>Naissance </span>: <?= $user["datedenaissance"] ?></p>
                    </div>
                    <div class="bio-row">
                        <p><span>pseudo </span>: <?=  $user["pseudo"] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div>
        
        </div>
    </div>
    </div>
    <h1>Mes Posts</h1>
    <?php
    $posts=$db->getAllPostsByIduser($user["id_user"]);
    foreach($posts as $post) : 
        ?>
  <?php $nombre = $db->getCountforPostbyIdpost($post["id_post"]);?>

        
<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-15">

      <div class="container gedf-wrapper">
      <div class="card ">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                <?php 
                  if($user["image"] != null) : ?>
                    <img src="../uploads/<?=  $user["image"] ?>"   class="w-100 avatar-post" />
                  <?php elseif ($user["image"] == null) : ?>
                    <img src="../uploads/avatar.png"  class="w-100"/>
                  <?php endif ; ?>
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-6">
                <h5><?= $post["titre"] ?></h5>
               
              <hr>
               
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1"><?=  $post["date"] ?></h4>
                <hr>
                </div>
                <div class="d-flex flex-column mt-4">
                 
                  <a class="btn btn-lg btn-square btn-info text-info-hover"   href="../views/SinglepagePost.php?post_id=<?php echo intval($post['id_post']); ?>&user_id=<?php echo intval($post['id_user']); ?>"><i class="bi bi-trash"></i> Voir plus</a><br>
                  <?php
                  //Gestion des likes et dislikes
                            
                            if ( $db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == true ) {
                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p>
                                <a href="../model/addLikeUser.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'" style="max-width: 240px" class="btn btn-danger " >  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg> Like 
                                </a> &nbsp;&nbsp;&nbsp;
                       
                                                                                                                    
                                ';
                            }elseif($db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == false ) {
                              

                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p>
                                <a href="../model/addLikeUser.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'"  style="width: 240px" class="btn btn-danger " style="width: 250px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586ZM7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77Z"/>
                                </svg> Dislike 
                            </a> &nbsp;&nbsp;&nbsp;
                                ';
                            }
                            ?>  
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  
  </div>
</section>
<?php endforeach ; ?>
<script>
  // Afficher/cacher le reste du message en cliquant sur le bouton
  const preview = document.querySelector('.preview');
  const full = document.querySelector('.full');
  const toggleBtn = document.querySelector('.toggle-preview');

  toggleBtn.addEventListener('click', () => {
    if (preview.style.display === 'none') {
      preview.style.display = 'block';
      full.style.display = 'none';
      toggleBtn.textContent = 'Voir plus';
    } else {
      preview.style.display = 'none';
      full.style.display = 'block';
      toggleBtn.textContent = 'Voir moins';
    }
  });
</script>
</body>
</html>
