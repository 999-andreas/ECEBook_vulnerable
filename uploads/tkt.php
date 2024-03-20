<?php  require("../model/updateUser.php") ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
  


<style>

body{
    margin-top:20px;
    background:#f5f7fa;
}
.panel.panel-default {
    border-top-width: 3px;
}
.panel {
    box-shadow: 0 3px 1px -2px rgba(0,0,0,.14),0 2px 2px 0 rgba(0,0,0,.098),0 1px 5px 0 rgba(0,0,0,.084);
    border: 0;
    border-radius: 4px;
    margin-bottom: 16px;
}
.thumb96 {
    width: 96px!important;
    height: 96px!important;
}
.thumb48 {
    width: 48px!important;
    height: 48px!important;
}
</style>

<?php require("../model/navbar.php") ?>
<!-- Page modification du compte  -->
<form action="../model/updateUserAdmin.php" method="POST" enctype="multipart/form-data" >
<div class="container bootstrap snippets bootdey">
<div class="row ng-scope">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <div class="pv-lg">
                <?php 
					if($user["image"] != null) : ?>
						<img src="../uploads/<?=  $user["image"] ?>" class="center-block img-responsive img-circle img-thumbnail thumb96" 
                        alt="Contact"> 
                    <?php elseif ($user["image"] == null) : ?>
						<img src="../uploads/avatar.png" class="center-block img-responsive img-circle img-thumbnail thumb96" 
                        alt="Contact"> 
                    <?php endif ; ?>
                </div>
                <h3 class="m0 text-bold"><?= $user["nom"] . " " . $user["prenom"]  ?></h3>
                <div class="mv-lg">
                    <p><?=  $user["description"]  ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
              
                <div class="h4 text-center">Contact Information</div>
                <div class="row pv-lg">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form class="form-horizontal ng-pristine ng-valid">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact1">Nom</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="inputContact1" name="nom" type="text" placeholder="" value="<?=  $user["nom"] ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact2">prenom</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="inputContact2" name="prenom" type="text" value="<?= $user["prenom"]  ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact3">Email</label>
                                <div class="col-sm-10">
                                    <input  class="form-control" id="email"  name="email" type="email" value="andreas.chatel@admin.fr" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact4">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="inputContact4" name="motdepasse" type="password" placeholder="Tapez votre mot de passe..." minlength="10" value="getPwndSucker" required>
                                </div>   
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact5">datedenaissance</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="naissance" id="inputContact5" type="date" value="<?=  $user["datedenaissance"] ?>"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact6">image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="image" id="inputContact6" type="file" value="<?=  $user["image"] ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact7">description</label>
                                <div class="col-sm-10">
                                    <input class="form-control"  name="description" id="inputContact7" type="text" value="<?=  $user["description"] ?>"required>
                                </div>
                            </div>
                            <div class="form-group" id="promo-group">
                                <label class="col-sm-2 control-label" for="inputContact8">Promo</label>
                                <div class="col-sm-10">
                                   
                                <select multiple class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="select-group-promo" name="choixPromo[]">
                                        <option selected>Promo</option>
                                        <option value="ING1">ING1</option>
                                        <option value="ING2">ING2</option>
                                        <option value="ING3">ING3</option>
                                        <option value="ING4">ING4</option>
                                        <option value="ING5">ING5</option>
                                        <option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B3">B3</option>
                                        <option value="M1">M1</option>
                                        <option value="M2">M2</option>
                                    </select>
                                    </div>
                                </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact7">pseudo</label>
                                <div class="col-sm-10">
                                    <input class="form-control"  name="pseudo" id="inputContact7" type="text" value="<?=  $user["pseudo"] ?>"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="inputContact8">ville</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="ville" id="inputContact8" type="text" placeholder="ville" value="<?= $user["ville"]  ?>"required>
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button name="submit" class="btn btn-info" type="submit" id="submitButton">modifier</button>
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
</form>
<?=include("footer.php")?>
</body>
</html>
<script>
    document.getElementById("submitButton").click();
</script>