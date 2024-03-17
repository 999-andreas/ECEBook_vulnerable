<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
}


require("../model/SinglepagePost.php");
 $nombre = $db->getCountforPostbyIdpost($post["id_post"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
    crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-lq1jB4rkYZfoUUvIaXwh3pZlnbvyopoPb+aWYsIrpTmGkPTF/m2rdEJGU6zCj3X2" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <link rel="stylesheet" href="../style/SinglepagePost.css">
</head>
<body>
    <?php require("../model/navbar.php") ?>
<div class="blog-single gray-bg">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <div class="article-img">
                            <?php if($post["image"] != null) : ?>
                            <img src="../uploads/<?=  $post["image"] ?>" title="" alt="">
                            <?php else :   ?>
                                <img src="https://www.vill.ogasawara.tokyo.jp/wp-content/themes/ogasawara/img/access/no_image.png" alt="" srcset="">
                            <?php endif  ?>
                        </div>
                        <div class="article-title">
                            <h2><?=  $post["titre"] ?></h2>
                           
                        </div>
                        <div class="article-content">
                           <p>
                                <?= nl2br(htmlspecialchars($post["message"]))  ?>

                           </p>
                        </div>
                        <div class="nav tag-cloud">
                            <a href="">Likes : <?=  $nombre ?> </a>
                           
                        </div>
                    </article>
               
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                
                    <div class="widget widget-author">
                        <div class="widget-title">
                            <h3>Auteur</h3>
                        </div>
                        <div class="widget-body">
                            <div class="media align-items-center">
                                <div class="avatar">
                                    <img src="../uploads/<?=  $user["image"] ?>" title="" alt="">
                                </div>
                                <div class="media-body">
                                    <h6>Bonjour, je suis<br> <?=  $user["pseudo"] ?></h6>
                                </div>
                            </div>
                            <p><?=  $user["description"] ?></p>

                        </div>
                    

                    </div>
                
                    <div class="widget widget-tags">
                        <div class="widget-title">
                            <h3>Actions</h3>
                        </div>
                        <div class="widget-body">
                            <div class="nav ">
                            <a class="btn btn-primary btn-lg"  href="./modifPostByUser.php?post_id=<?=  intval($post['id_post']) ; ?>&user_id=<?= intval($post['id_user']) ; ?>"> <i class="bi bi-trash"></i> Modifier</a>
                  <hr>
                  <a class="btn btn-lg btn-square btn-danger text-danger-hover" href="../model/deletePost.php?post_id=<?php echo intval($post['id_post']); ?>&user_id=<?php echo intval($post['id_user']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?');"><i class="bi bi-trash"></i> Supprimer</a>
                            </div>
                        </div>
                    </div>
                 
                   
                
                </div>
                
            </div>
            
        </div>
    </div>
</body>
</html>