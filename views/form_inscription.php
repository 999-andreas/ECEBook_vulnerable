
<?php 
session_start();
if(isset($_SESSION["id_user"])){
    // Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil
    header("Location: ../views/index2.php");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_form_inscription.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Inscription</title>
</head>

<body>

    <?php   require("../model/navbar.php") ?>
    <hr>
    <h1 style="text-align: center" class="text-dark text-center moving-heading">INSCRIPTION</h1>
    <form action="../model/inscription.php"  method="POST" enctype="multipart/form-data">
        <!-- form inscription -->


  
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-5 m-auto">
                    <div class="card">
                        <div class="card-body">

                                  
                       
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Nom</span>
                                    <input class="form-control" type="text" name="nom" placeholder="Tapez votre nom..." required><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Prénom</span>
                                    <input class="form-control" type="text" name="prenom" placeholder="Tapez votre prénom..." required><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <input class="form-control" type="file" name="image" ><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Date de naissance</span>
                                    <input class="form-control" id="datefield" type="date" name="naissance" placeholder="Date" required><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Ville</span>
                                    <input class="form-control" type="text" name="ville" placeholder="Ville" required><br><br>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Email</span>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Tapez votre email..." required><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3" id="promo-group">
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
                

                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Username</span>
                                    <input class="form-control" type="text" name="username" placeholder="Votre username" required><br><br>
                                </div>
                            </div>
                           
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Password</span>
                                    <input class="form-control" type="password" name="motdepasse" placeholder="Tapez votre mot de passe..." minlength="10"><br><br>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group mb-3 w-100 flex-nowrap">
                                    <span class="input-group-text">Description</span>
                                    <input class="form-control" type="text" name="description" placeholder="Tapez votre mot de passe..."><br><br>
                                </div>
                            </div>
                            <input class="btn btn-primary btn-lg" style="margin-left: 39%;" type="submit" name="submit" value="S'inscrire"><br><br>
                            <a href="connexion.php" style="margin-left: 36%;">J'ai déjà un compte</a><br><br>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>



    <script>

    const emailInput = document.getElementById('email');
    const promoGroup = document.getElementById('promo-group');

    // DEBUT CODE JORDAN POUR LISTE PROMO
    var selectPromo = document.getElementById('select-group-promo');
    selectPromo.disabled = true;
    emailInput.addEventListener("input", function(){
        if (emailInput.value.length > 0){
            selectPromo.disabled = false;
        } else {
            selectPromo.disabled = true;
        }
    });
    // FIN CODE JORDAN


    emailInput.addEventListener('blur', () => {
        const email = emailInput.value.trim();
        const domain = email.split('@')[1];

        const promoGroup = document.getElementById('promo-group');

        if (domain === 'omnes.intervenant.fr') {
        promoGroup.style.display = 'block';
        // CODE JORDAN DEBUT
        selectPromo.multiple = true;
        } else if (domain === 'edu.ece.fr') {
            promoGroup.style.display = 'block';
            selectPromo.multiple = false;
        } // FIN CODE JORDAN 
        else {
        promoGroup.style.display = 'none';
        }
    });

    // SET DATE MAX
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
    dd = '0' + dd;
    }

    if (mm < 10) {
    mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);

// FIN SET DATE MAX


</script>


</body>

</html>