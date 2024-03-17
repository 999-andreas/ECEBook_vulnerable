<?php

require("../controller/database.php");
session_start();

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}
//suppresion des users par l'admin
$db = new Database();


    $db->deleteUserById($_GET["user_id"]);
   
    header("location: ../views/dashboard.php");
    exit();
    

?>
