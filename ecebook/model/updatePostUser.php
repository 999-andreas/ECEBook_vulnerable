<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../controller/database.php");

if(isset($_SESSION["id_user"])){
	
	$db = new Database();
	$user = $db->GetUserById($_SESSION["id_user"]);
}


$db = new Database();

try {
    if(isset($_POST["submit"])){
        $post_id =  intval($_GET["post_id"]);
        $titreP = $_POST["titre"] ?? '';
        $messageP = $_POST["message"] ?? '';
        
        $imagePost = $_FILES['image']['name'];// pas de controle des type de fichier
        $filetmpname = $_FILES['image']['tmp_name'];
        
        $folder = '../uploads/';
        move_uploaded_file($filetmpname, $folder . $imagePost);
      

        $db->updatePostById($post_id,$titreP,$messageP,$imagePost);
    
        header("location: ../views/profile.php");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
