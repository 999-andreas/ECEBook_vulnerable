<?php
/*
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

include("../model/data.php");

require("../controller/database.php");


if (isset($_POST['input'])){
    $input = $_POST['input']; 
    $db = new Database();
    $res = $db->navBar($input);

    
    $req = "SELECT * FROM utilisateur WHERE pseudo LIKE '{$input}%'";
    $res = mysqli_query($conn, $req);
    
    
    $abonnements = $db->getSubsByUser1Id($_SESSION['id_user']);

    
    if (row_count($res) > 0){?>
        <table style="margin-left: 46%; margin-top: 40px;">
            <thead class="col-6 col-md-4">
                <th>Utilisateurs</th>
            </thead>
            <tbody>

                <?php
                while ($row = mysqli_fetch_assoc($res)){
                    $id_User = $row['id_user'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $pseudo = $row['pseudo'];

                    ?>

                    <tr>
                        <td>
                            <?php echo $id_User;?>
                            <?php echo $nom;?>
                            <?php echo $prenom;?>
                            <?php echo $pseudo;?>
                            <?php
                            $abonné = 0;
                            $id_abonne = $row['id_user'];
                            foreach($abonnements as $abonnement)
                            {
                                if($abonnement['user2_id'] == $row['id_user'])
                                {
                                    $abonné = 1;                                    
                                    
                                }
                            }?>


                            <?php if($abonné==1):?>
                                <a href="../model/deleteSub.php?id_abonné=<?php echo $id_abonne ?>" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                </svg>
                                </a>
                            <?php else :?>
                                <a href="../model/envoie_mail_subs.php?id_abonné=<?php echo $id_abonne ?>" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                </svg>
                                </a>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
    } else {
        echo "No data found";
    }
}
?>


<style>
    svg:hover{
        color: green;
    }
</style>
*/
error_reporting(E_ERROR | E_PARSE);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.html");
}

include("../model/data.php");

require("../controller/database.php");


if (isset($_POST['input'])){
    $input = $_POST['input']; 
    $db = new Database();
    $res = $db->navBar($input);
    $abonnements = $db->getSubsByUser1Id($_SESSION['id_user']);

}

?>
<?php
foreach ($res as $utilisateur):?>
<table style="margin-left: 46%; margin-top: 40px;"> 
    <tbody>
        <tr>
            <td>
            <?php
                $id_User = $utilisateur['id_user'];
                $nom = $utilisateur['nom'];
                $prenom = $utilisateur['prenom'];
                $pseudo = $utilisateur['pseudo'];

                echo $id_User . ' ' . $nom . ' ' . $prenom . ' ' . $pseudo;
            ?>
            <?php
            $abonné = 0;
            $id_abonne = $utilisateur['id_user'];
            foreach($abonnements as $abonnement)
            {
                if($abonnement['user2_id'] == $utilisateur['id_user'])
                {
                    $abonné = 1;                                    
                    
                }
            }?>


            <?php if($abonné==1):?>
                <a href="../model/deleteSub.php?id_abonné=<?php echo $id_abonne ?>" >
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                </svg>
                </a>
            <?php else :?>
                <a href="../model/envoie_mail_subs.php?id_abonné=<?php echo $id_abonne ?>" >
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                </svg>
                </a>
            <?php endif;?>
            </td>
        </tr>
    </tbody>
</table>
    
<?php endforeach; ?>
