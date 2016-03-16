<!DOCTYPE html>
<html lang="es">
<?php require_once('./views/head.php'); ?>
<body>
    <div class="container">
        <?php 
        

        $Querys = new Querys();
		$paramsUser['user'] = $_SESSION['user_path'];
		$userValues = $Querys->AdminUserByUser($paramsUser);

		

		if(!isset($_SESSION['userinfo']['name'])){
			$username = $userValues->getName();
			$userlink = './perfil';
			$userRol = $userValues->getRolId();
		}else{
			$username = $_SESSION['userinfo']['name'];
			$userlink =  $_SESSION['userinfo']['link'];
			$userRol = 2;
		}

        require_once('./views/menu.php'); 
        ?>
    </div>
    <div class="container-fluid" id="content" role="main">
        <?php getRoute()->run(); ?>
    </div>
    <div class="text-center powered-google"><img src="./img/powered_by_google_on_white_hdpi.png"></div>
</body>
<?php require_once('./views/foot.php'); ?>
</html>