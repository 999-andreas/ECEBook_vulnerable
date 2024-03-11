<?php 

require("../model/userProfileModel.php");

$db = new Database();
$posts= $db->getAllPostsByIduser($_SESSION["id_user"]);
$post_numbers_total = $db->getPostCountByUserId($user_profile["id_user"]);
$abonnements=$db-> getAllAbonnements();
?>

<!-- Afichage des informations, posts et gestion du compte de l'user à qui on est abonné  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-lq1jB4rkYZfoUUvIaXwh3pZlnbvyopoPb+aWYsIrpTmGkPTF/m2rdEJGU6zCj3X2" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../style/userProfile.css">
</head>
<body>
<?php require("../model/navbar.php") ?>
<div class="layout-content">

          <!-- Content -->
          <div class="container flex-grow-1 container-p-y">

            <!-- Header -->
            <div class="container-m-nx container-m-ny theme-bg-white mb-4">
              <div class="media col-md-10 col-lg-8 col-xl-7 py-5 ">
              <?php if($user["image"] != null) : ?>
                      <img class="d-block ui-w-100 rounded-circle" width="" 
                      src="../uploads/<?= $user_profile["image"]  ?>" alt="">
              <?php elseif ($user["image"] == null) : ?>
                      <img class="d-block ui-w-100 rounded-circle" width="" 
                      src="../uploads/avatar.png" alt="">
              <?php endif ; ?>
                <div class="media-body ml-5">
                  <h4 class="font-weight-bold mb-4"><?=   $user_profile["nom"] . " " . $user_profile["prenom"] ?></h4>

                  <div class="text-muted mb-4">
                    <?=  $user_profile["description"]  ?>
                  </div>
                  
                  <a href="javascript:void(0)" class="d-inline-block text-body">
                    <strong><?= $nb_abonnement  ?></strong>
                    <span class="text-muted">followers</span>
                  </a>
                  <a href="javascript:void(0)" class="d-inline-block text-body ml-3">
                    <strong><?= $nb_abonné ?></strong>
                    <span class="text-muted">following</span>
                  </a>
                </div>
              </div>
              <hr class="m-0">
            </div>
            <!-- Header -->

            <div class="row">
              <div class="col">

                <!-- Info -->
                <div class="card mb-4">
                  <div class="card-body">

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">date de naissance:</div>
                      <div class="col-md-9">
                        <?=  $user_profile["datedenaissance"] ?>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">ville</div>
                      <div class="col-md-9">
                        <a href="javascript:void(0)" class="text-body"><?=  $user_profile["ville"]  ?></a>
                      </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Email : </div>
                      <div class="col-md-9">
                        <a href="javascript:void(0)" class="text-body"><?=  $user_profile["adressemail"]  ?></a>
                      </div>
                    </div>

                   

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Promo : </div>
                      <div class="col-md-9">
                        <?=   $user_profile["promo"] ?>
                      </div>
                    </div>

                 

                    <div class="row mb-2">
                      <div class="col-md-3 text-muted">Role : </div>
                      <div class="col-md-9">
                      <?=  $user_profile["roll"] ?>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center p-0">
                    <div class="row no-gutters row-bordered row-border-light">
                      <a href="javascript:void(0)" class="d-flex col flex-column text-body py-3">
                        <div class="font-weight-bold"><?= $post_numbers_total  ?></div>
                        <div class="text-muted small">posts</div>
                      </a>
                      
                    </div>
                  </div>
                </div>
               
             

              
                <?php   
                $posts=$db->getAllPostsByIduser($user_profile["id_user"]);
                
                foreach($posts as $post) :
                  $nombre = $db->getCountforPostbyIdpost($post["id_post"]);

               ?>

                <div class="card mb-4">
                  <div class="card-body">
                   

                    <div class="border-top-0 border-right-0 border-bottom-0 ui-bordered pl-3 mt-4 mb-2">
                      <div class="media mb-3">
                      <?php if($user["image"] != null) : ?>
                              <img class="d-block ui-w-40 rounded-circle" width="45" 
                              src="../uploads/<?= $user_profile["image"]  ?>" alt="">
                            <?php elseif ($user["image"] == null) : ?>
                              <img class="d-block ui-w-40 rounded-circle" width="45" 
                              src="../uploads/avatar.png" alt="">
                            
                            <?php endif ; ?>
                        <div class="media-body ml-3">
                        <h4> <?=  $user_profile["nom"] . " " . $user_profile["prenom"] ?></h4>
                          <div ><p><?=  $post["date"] ?></p></div>
                        </div>
                      </div>
                      <p class="long-message preview-<?= $post['id_post'] ?>">
    <?php
    $message = nl2br(htmlspecialchars($post["message"]));
    $max_length = 100; // longueur maximale du message à afficher
    if (strlen($message) > $max_length) {
        $truncated_message = substr($message, 0, $max_length) . "...";
        echo '<span class="preview">' . $truncated_message . '</span>';
        echo '<span class="full" style="display: none;">' . $message . '</span>';
        echo '<button class="toggle-preview btn btn-link" type="button" data-target="#collapseExample-' . $post['id_post'] . '">Voir plus</button>';
        echo '<button class="toggle-full btn btn-link" type="button" style="display: none;" data-target="#collapseExample-' . $post['id_post'] . '">Voir moins</button>';
    } else {
        echo '<span class="preview">' . $message . '</span>';
    }
    ?>

</p>
                      <?php if($post["image"] != null) : ?>
                        
                      <img  src="../uploads/<?=  $post["image"] ?>" alt="" srcset="" class="ui-rect ui-bg-cover">
                    <?php endif ?>
                    </div>
                  </div>
                  <div class="card-footer">
                    <?php $nombreLikes = $db->getCountforPostbyIdpost($post["id_post"]); ?>
                    <a href="javascript:void(0)" class="d-inline-block text-muted">
                     
                        <?php
                            
                            if ( $db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == true ) {
                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p><br>
                                <a href="../model/addLikeUser.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'" style="width: 240px" class="btn btn-danger " style="width: 250px">  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg> Like 
                                </a> &nbsp;&nbsp;&nbsp;
                       
                                                                                                                    
                                ';
                            }elseif($db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == false ) {
                              

                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p><br>
                                <a href="../model/addLikeUser.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'"  style="width: 240px" class="btn btn-danger " style="width: 250px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586ZM7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77Z"/>
                                </svg> Dislike 
                            </a> &nbsp;&nbsp;&nbsp;
                                ';
                            }
                            ?>  
                    </a>
                    <button class="toggle-comments btn btn-link" type="button" data-post-id="<?= $post['id_post'] ?>">Commentaire</button>

                  
                  </div>


                  <div style="display: none" id="comments-container-<?= $post['id_post'] ?>" class="container mt-5 mb-5">
    <div class="row height d-flex justify-content-center align-items-center">
        <div  style="width:100%">
            <div class="card">
                <div class="p-3">
                    <h6>Commentaire</h6>
                </div>
                <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                    <?php if($_SESSION["image"] != null) : ?>
                              <img width="50" class="rounded-circle mr-2"
                              src="../uploads/<?= $_SESSION["image"]  ?>" alt="">
                            <?php elseif ($_SESSION["image"] == null) : ?>
                              <img width="50" class="rounded-circle mr-2"
                              src="../uploads/avatar.png" alt="">
                            <?php endif ; ?>


                    <form style="display:flex;width : 100%" action="../model/addComment.php?id_post=<?= $post['id_post'] ?>" method="post">
                        <input type="hidden" name="id_post" value="<?= $post['id_post'] ?>">
                        <input type="text" class="form-control" name="comment" placeholder="Entrez votre commentaire...">
                        <button type="submit" class="btn btn-primary ml-2">Ajouter</button>
                    </form>
                </div>
                <?php $comments = $db->GetCommentByPostId($post['id_post']); ?>
                <?php if ($comments): ?>
                    <?php foreach ($comments as $comment): ?>
                        <?php $user = $db->GetUserById($comment['id_user']); ?>
                        
        <div class="mt-2">
            <div class="d-flex flex-row p-3">


            <?php if($user["image"] != null) : ?>
                              <img width="40" height="40" class="rounded-circle mr-3"
                              src="../uploads/<?= $user["image"]  ?>" alt="">
                            <?php elseif ($user["image"] == null) : ?>
                              <img width="40" height="40" class="rounded-circle mr-3"
                              src="../uploads/avatar.png" alt="">
                            <?php endif ; ?>
                <div class="w-100 commentaire">
                    <span class="text-muted font-weight-bold"><?= $user['pseudo'] ?></span>
                    <p class="text-justify comment-text mb-0"><?= $comment['contenu'] ?></p>
                </div>
            </div>
        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="p-3">Aucun commentaire pour le moment.</p>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>  
        
            


                </div>
        <?php endforeach ; ?>
                <!-- / Posts -->

              </div>
              <div class="col-xl-4">

                <!-- Side info -->
                
                <div class="card mb-4">
                  <div class="card-body">
                  <?php 
                  // Vérifier si l'utilisateur actuel est abonné à l'utilisateur en cours d'affichage
                  $isSubscribed = false;
                  
                  foreach($abonnements as $abonnement){
                      if($abonnement["user1_id"] == $_SESSION['id_user'] && $abonnement["user2_id"] == $user_profile['id_user']){
                          $isSubscribed = true;
                          break;
                      }
                  }
                  ?>
                 
              <?php if($isSubscribed) : ?>
                <a href="../model/deleteSub.php?id_abonné=<?= $user_profile["id_user"] ?>" class="btn btn-primary rounded-pill">-&nbsp; Suivi</a>
                <?php else : ?>
                  <a href="../model/envoie_mail_subs.php?id_abonné=<?= $user_profile["id_user"] ?>" class="btn btn-primary rounded-pill">+&nbsp; Suivre</a>
                  <?php endif; ?>
                  
              
                  
                </div>
                <hr class="border-light m-0">
                 
                  <hr class="border-light m-0">
                
                </div>
                <!-- / Side info -->

       

               
              </div>
            </div>

          </div>
          <!-- / Content -->

         
        </div>
        <?php require("./footer.php") ?>





        <script>
  document.addEventListener("DOMContentLoaded", function() {
    const previews = document.querySelectorAll('.preview');
    const fulls = document.querySelectorAll('.full');
    const togglePreviewBtns = document.querySelectorAll('.toggle-preview');
    const toggleFullBtns = document.querySelectorAll('.toggle-full');

    togglePreviewBtns.forEach((btn, i) => {
      btn.addEventListener('click', () => {
        previews[i].style.display = 'none';
        fulls[i].style.display = 'block';
        togglePreviewBtns[i].style.display = 'none';
        toggleFullBtns[i].style.display = 'inline';
      });
    });

    toggleFullBtns.forEach((btn, i) => {
      btn.addEventListener('click', () => {
        fulls[i].style.display = 'none';
        previews[i].style.display = 'block';
        toggleFullBtns[i].style.display = 'none';
        togglePreviewBtns[i].style.display = 'inline';
      });
    });
  });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleCommentsButtons = document.querySelectorAll('.toggle-comments');

        toggleCommentsButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                const postId = event.target.getAttribute('data-post-id');
                const commentsContainer = document.querySelector(`#comments-container-${postId}`);

                if (commentsContainer.style.display === 'none') {
                    commentsContainer.style.display = 'block';
                } else {
                    commentsContainer.style.display = 'none';
                }
            });
        });
    });
</script>
        
</body>
</html>