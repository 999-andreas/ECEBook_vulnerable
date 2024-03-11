<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../controller/database.php");

if(isset($_SESSION["id_user"])){
	
	$db = new Database();
	$user = $db->GetUserById($_SESSION["id_user"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../style/navbar.css">

</head> 
<body>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
	<a href="#" class="navbar-brand"><i class="fa fa-cube"></i>ECE<b>BOOK</b></a>  		
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">		
		<?php if(isset($_SESSION["id_user"])) : ?>
		<form class="navbar-form form-inline">
			<div class="input-group search-box">
				<!--								
				<input type="text" class="form-control" id="live_search" autocomplete="off"
            		placeholder="Search...">-->
			</div>
		</form>
		<div id="searchresult"> </div>
		<?php endif ; ?>
		

		<?php if(isset($_SESSION["id_user"])) : ?>
		<div class="navbar-nav ml-auto">
			<a href="../views/index2.php" class="nav-item nav-link active"><i class="fa fa-home"></i><span>Accueil</span></a>
			<a href="../views/navSearchUsers.php" class="nav-item nav-link"><i class="fa fa-gears"></i><span>Recherche</span></a>
			<a href="../views/messagerie.php" class="nav-item nav-link"><i class="fa fa-envelope"></i><span>Messages</span></a>	
			<div class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action">
				<?php 
					if($user["image"] != null) : ?>
						<img src="../uploads/<?=  $user["image"] ?>" class="avatar" alt="Avatar"> <?=  $user["pseudo"] ?> 
                    <?php elseif ($user["image"] == null) : ?>
						<img src="../uploads/avatar.png" class="avatar" alt="Avatar"> <?=$user["pseudo"] ?> 
                    <?php endif ; ?>	
					
				</a>

				<div class="dropdown-menu">
					<a href="../views/profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a>
					<div class="divider dropdown-divider"></div>
					<a href="../model/logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
				</div>
			</div>
		</div>
        <?php endif ; ?>







		<?php if(!isset($_SESSION["id_user"])) : ?>
		<div class="navbar-nav ml-auto">
			<a href="../views/connexion.php" class="nav-item nav-link"><i class="fa fa-gears"></i><span>connexion</span></a>
			<a href="../views/form_inscription.php" class="nav-item nav-link"><i class="fa fa-users"></i><span>inscription</span></a>
		</div>
        <?php endif ; ?>




		

   
	</div>
</nav>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#live_search").keyup(function(){
                var input = $(this).val();
                //alert(input);
                if (input != ""){
                    $.ajax({
                        url:"livesearch.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#searchresult").html(data);
                            $("#searchresult").css("display","block");
                        }
                    });
                }else{
                    $("#searchresult").css("display","none");
                }
            });
        });
    </script>
</html>