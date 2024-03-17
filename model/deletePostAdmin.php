<?php

require("../controller/database.php");
session_start();

if(!isset($_SESSION["admin"])){
    header("location: ../views/connexion.php");
    exit();
}

$db = new Database();


    $db->deletePostById($_GET["post_id"]);
   
    header("location: ../views/dashboard.php");
    exit();
    

?>
