<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location:../views/connexion.php");
    exit();
}

require("../controller/database.php");
$db = new Database();
$posts = $db->getAllPosts();
$subs = $db->getSubsByUser1Id($_SESSION["id_user"]);
$popular = $db->getPopularAccounts();

if (empty($subs)) {
    // Si l'utilisateur n'est abonné à personne, on ne garde que les posts publique
    $posts = array_filter($posts, function ($post) {
        return $post['publique'] == 1;
    });
} else {
    // Sinon, on filtre les posts en fonction des abonnements de l'utilisateur
    foreach ($posts as $key => $post) {
        $keep = false;
        foreach ($subs as $sub) {
            if ($post['id_user'] == $sub['user2_id'] || $post['publique'] == 1) {
                $keep = true;
                break;
            }
        }
        if (!$keep) {
            unset($posts[$key]);
        }
    }
}

// Ré-indexer les éléments du tableau $posts
$posts = array_values($posts);


?>

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


</head>
<body>
    


<style>
    body {
            background-color: #eeeeee;
            overflow-x : hidden;
            box-sizing: border-box;
        }

        .h7 {
            font-size: 0.8rem;
        }

        .gedf-wrapper {
            margin-top: 0.97rem;
        }

        @media (min-width: 992px) {
            .gedf-main {
                padding-left: 4rem;
                padding-right: 4rem;
            }
            .gedf-card {
                margin-bottom: 2.77rem;
            }
        }

        .commentaire{
            border-bottom : 1px solid #D9DDDC	;
            width : 100%;
            height : auto;
            display : flex;
            align-items : center;
            
            
        }

        /**Reset Bootstrap*/
        .dropdown-toggle::after {
            content: none;
            display: none;
        }

        #card-populaires {
            margin-left: 42%;
            margin-top: 20px;
        }

        .card{
          box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        .image-post {
            
            max-width : 100%;
            min-width : 100%;
            border-radius : 8px
            
        }

        .btn-danger,
.btn-info,.btn-primary {
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
</style>
 <!-- page principale, gestion des posts likes et dislikes -->
       
<?php  require("../model/navbar.php") ?>

<div class="card shadow p-3 mb-5 bg-white rounded" id="card-populaires" style="width: 18rem;">
    <div class="card-header text-center border-5 border-secondary" style="background: #d63384;color: #fff">
    Comptes populaires
    </div>
    <?php   foreach($popular as $popularUser): ?>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">
        <a href="../views/profileUser.php?user_id=<?= $popularUser["id_user"]?>"><?=  $popularUser["pseudo"] ?></a>
    </li>
        
    </ul>
    <?php endforeach ; ?>
</div>

    <div class="container gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
               
            </div>
            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <form action="../model/addPost.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="card gedf-card " >
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Publiez </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    
                                        <input class="form-control" type="text" name="titre" placeholder="entrez un titre" required><br><br>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message">Post</label>
                                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="entrez un message ?"></textarea>
                                        <label for="publique">publique :</label>
                                        <input type="checkbox" id="publique" name="publique" value="1">
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" name="submit" class="btn btn-primary">Publier</button>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Post /////-->

                <!--- \\\\\\\Post-->
                <?php foreach ($posts as $post): ?>
                    <?php       

                    // Get user information
                    $user_id = $post['id_user'];
                    $user = $db->getUserById($user_id);
                    $nombre = $db->getCountforPostbyIdpost($post["id_post"]);
                    $comments = $db->GetCommentByPostId($post['id_post']); 
                    ?>
  <div class="card gedf-card ">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                    <?php 
                                    if($user["image"] != null) : ?>
                                        <a href="../views/profileUser.php?user_id=<?=  $user_id ?>">
                                        <img class="rounded-circle" width="45" src="../uploads/<?= $user["image"]  ?>" alt=""></a>
                                    <?php elseif ($user["image"] == null) : ?>
                                        <a href="../views/profileUser.php?user_id=<?=  $user_id ?>">
                                        <img class="rounded-circle" width="45" src="../uploads/avatar.png" alt=""></a>
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
    <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i><?= $post["date"]?></div>
    <a class="card-link" href="">
        <h5 class="card-title"><?= $post["titre"] ?></h5>
    </a>
    <p class="long-message preview-<?= $post['id_post'] ?>">
    <?php
    $message = nl2br(htmlspecialchars($post["message"]));
    $max_length = 200; // longueur maximale du message à afficher
    if (strlen($message) > $max_length) {
        $truncated_message = substr($message, 0, $max_length) . "......";
        echo '<span class="preview">' . $truncated_message . '</span>';
        echo '<span class="full" style="display: none;">' . $message . '</span>';
        echo '<button class="toggle-preview btn btn-link" type="button" data-target="#collapseExample-' . $post['id_post'] . '">Voir plus</button>';
        echo '<button class="toggle-full btn btn-link" type="button" style="display: none;" data-target="#collapseExample-' . $post['id_post'] . '">Voir moins</button>';
    } else {
        echo '<span class="preview">' . $message . '</span>';
    }
    ?>

</p>

  <img src="../uploads/<?= $post["image"] ?>" alt="" srcset="" class="image-post">

  </div>

                        <div class="card-footer">
                        
                            <?php
                            
                            if ( $db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == true ) {
                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p>
                                <a href="../model/addLike.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'" style="width: 250px" class="btn btn-danger mx-auto" style="width: 250px"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg> Like 
                                </a> &nbsp;&nbsp;&nbsp;';
                            }elseif($db->userLikesAnnonce($_SESSION['id_user'],$post["id_post"]) == false ) {
                            

                                echo '
                                <p><span>Likes </span>: '.$nombre.'</p>
                                <a href="../model/addLike.php?user_id='.$_SESSION['id_user'].'&post_id='.$post["id_post"].'"  style="width: 250px" class="btn btn-danger mx-auto" style="width: 250px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586ZM7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77Z"/>
                                </svg> Dislike 
                            </a> &nbsp;&nbsp;&nbsp;
                                ';
                            }
                            ?>  
 <button class="toggle-comments btn btn-link" type="button" data-post-id="<?= $post['id_post'] ?>">Commentaire</button>
                         
                    </div>
      <div style="display: none" id="comments-container-<?= $post['id_post'] ?>" class="container mt-5 mb-5">
    <div class="row height d-flex justify-content-center align-items-center">
        <div  style="width:100%">
            <div class="">
                <div class="p-3">
                    <h6>Commentaire</h6>
                </div>
                <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                <?php if($_SESSION["image"] != null) : ?>
                              <img width="50" class="rounded-circle mr-2"
                              src="../uploads/<?= $_SESSION["image"]  ?>" alt="">
                            <?php elseif ($_SESSION["image"]== null) : ?>
                              <img width="50" class="rounded-circle mr-2"
                              src="../uploads/avatar.png" alt="">
                            <?php endif ; ?>
                    <form style="display:flex;width : 100%" action="../model/addComment.php?id_post=<?= $post['id_post'] ?>" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
            <?php if( $user['image'] != null) : ?>
                              <img width="40" height="40" class="rounded-circle mr-3"
                              src="../uploads/<?= $user['image']   ?>" alt="">
                            <?php elseif ($user["image"] == null) : ?>
                              <img width="40" height="40" class="rounded-circle mr-3"
                              src="../uploads/avatar.png" alt="">
                            <?php endif ; ?>
                <div class="w-100 commentaire">
                    <span class="text-muted font-weight-bold"><?= $user['pseudo'] ?></span> <hr>
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



            </div>
         
        </div>
</div>

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




<?php require("./footer.php") ; ?>

</body>

</html>