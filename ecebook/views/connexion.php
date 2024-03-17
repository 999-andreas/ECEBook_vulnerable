<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["id_user"])){
    header("location:../views/profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_connexion.css" />
    <title>Connexion</title>
</head>
<body>

    <div class="rest-of-page">
        <hr>
        <h1 class="text-light text-center">Identification</h1><br><br>

        <form action="../model/connexion.php" method="POST">
            <div  class="container mt-5">
                <div class="row">
                    <div class="col-sm-5 m-auto">
                        <div class="card">
                            <div class="card-body">


                                <div class="form-group mb-3">
                                    <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">@</span>
                                        <input class="form-control w-75 p-3" aria-describedby="addon-wrapping" type="text" name="mail" placeholder="Tapez votre mail" required><br><br>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                        <span class="input-group-text">Password</span>
                                        <input class="form-control" type="password" name="password" placeholder="Tapez votre Mot de passe" required><br><br>
                                    </div>
                                </div>
                                <br><br><input style="margin-left: 37%;" class="btn btn-primary btn-lg" name="submit" type="submit" value="Connexion"><br><br>
                                <a href="./form_inscription.php" style="margin-left: 36%;">Vous souhaitez créer un compte ?</a><br><br>
                                <a href="../views/updateMdp.php" style="margin-left: 36%;">Réinitialisé votre mdp</a><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      
</body>
</html>