<?php

require("../controller/database.php");
session_start();

if(!isset($_SESSION["id_user"])){
    header("location: ../views/connexion.php");
    exit();
}
//suppresion des users
$db = new Database();


    $db->deleteUserById($_SESSION["id_user"]);
    session_destroy();
    header("location: ../views/form_inscription.php");
    exit();
    

?>
