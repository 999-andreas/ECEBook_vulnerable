<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Ping Utility</title>
</head>

<body>

    <div class="container" style="max-width: 50%">
        <a class="btn btn-primary" href="../views/index2.php" role="button" style="margin-left: -50%; margin-top: 15px;">Retour</a>
        <div class="text-center mt-5 mb-4">
            <h2>Recherche utilisateur</h2>
        </div>
        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search...">
    </div>

    <div id="searchresult"></div>


    <div class="container mt-5">
        <h3>Ping Utility</h3>
        <form action="" method="post" class="form-inline">
            <input type="text" name="ip" class="form-control mb-2 mr-sm-2" placeholder="Enter IP address or command">
            <button type="submit" name="Submit" class="btn btn-primary mb-2">Ping</button>
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            // Récupération et nettoyage de l'entrée pour n'autoriser que les caractères alphanumériques, le tiret et le point
            $target = preg_replace('/[^a-zA-Z0-9.-]/', '', $_POST['ip']);

            // Validation pour vérifier si l'entrée est une adresse IP ou un nom d'hôte valide
            if (filter_var($target, FILTER_VALIDATE_IP) || preg_match('/^([a-zA-Z0-9.-]+)$/', $target)) {
                // Commande ping basée sur le système d'exploitation
                $pingCommand = (stristr(php_uname('s'), 'Windows NT')) ? 'ping ' : 'ping -c 4 ';

                // Exécution de la commande ping uniquement
                $cmd = shell_exec($pingCommand . escapeshellarg($target));

                // Retour visuel pour l'utilisateur
                echo "<pre>{$cmd}</pre>";
            } else {
                echo "Adresse IP ou nom d'hôte invalide.";
            }
        }
        ?>


    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#live_search").keyup(function() {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "../model/livesearch.php",
                        method: "POST",
                        data: {
                            input: input
                        },

                        success: function(data) {
                            $("#searchresult").html(data);
                            $("#searchresult").css("display", "block");
                        }
                    });
                } else {
                    $("#searchresult").css("display", "none");
                }
            });
        });
    </script>
    <?php require("./footer.php") ?>
</body>

</html>