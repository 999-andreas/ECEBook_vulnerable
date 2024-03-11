
<?php

session_start();
if(!isset($_SESSION["admin"])){

echo "acces refusé 
<a href='#logout.php'>deconnecter</a>
<a href='index.php'>deconnecter</a>";
header("location:../views/connexion.php");


}
else{

}


?>

