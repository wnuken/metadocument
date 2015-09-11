<!DOCTYPE html>
<html lang="es">
<?php require_once('./views/head.php'); ?>
<body>
    <div class="container">
        <?php require_once('./views/menu.php'); ?>
    </div>
    <div class="container-fluid" id="content" role="main">
        <?php getRoute()->run(); ?>
    </div>
</body>
<?php require_once('./views/foot.php'); ?>
</html>