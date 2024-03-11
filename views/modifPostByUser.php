<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

require_once("../model/profil.php");


$db = new Database();

$post_id = intval($_GET["post_id"]);
$user_id = intval($_GET["user_id"]);
if (isset($post_id)) {
   
    $posts = $db->getPostsByIduserAndIdPost($user_id, $post_id);
};

 


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


<style>
    body{
    margin-top:20px;
    background:#f8f8f8
}

.card{
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}

</style>

<body>
<?php

foreach($posts as $post):

?>
 <!-- page modification user coté utilisateur -->

<?php require("../model/navbar.php") ?>

<div style="margin : 3% auto" class="container ">

<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
   
  </div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                 
                      <img  style="max-width : 100%;max-height : 100%" src="../uploads/<?=  $post["image"] ?>" alt="" srcset="">
                    </div>
                  </div>
                </div>
              
              </div>
             
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                <form action="../model/updatePostUser.php?post_id=<?=  $post['id_post']; ?>&user_id=<?=  $post['id_user'];?>"  method="POST" enctype="multipart/form-data">

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Titre</label>
                             
                              <input class="form-control" type="text" name="titre"  value="<?=  $post["titre"] ?>" >
                            </div>
                          </div>
                         
                        </div>
                    
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Message</label>
                              <textarea name="message" class="form-control" rows="5" >
                              <?= $post["message"] ?>
                              </textarea>
                            </div>
                          </div>
                        </div>



                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>image</label>
                              <input type="file" class="form-control" id="customFile" name="image">
                            </div>
                          </div>
                        </div>






                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" name="submit" type="submit">Sauvegarder les modifications</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<?php endforeach ; ?>


<?=  require("./footer.php") ?>
</body>
</html>