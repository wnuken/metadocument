<!DOCTYPE html>
<html lang="es">
    <?php require_once('./views/head.php'); ?>
    <body role="document">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
				</div>
                <div class="col-md-4"></div>
			</div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-center"><h3 class="panel-title">Metadocument</h3></div>
						</div>
                        <div class="panel-body">
                            <div class="text-center">
                                <div><img src="./img/logo.jpg"></div>
                                <p>Escoja como iniciar sesión: </p>
                                <div id="chagelogin" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-danger  active">
                                        <input name="type" id="type1a" autocomplete="off" checked value="metadocument" class="product_change" type="radio"> Metadocument
									</label>
                                    <label class="btn btn-danger">
                                        <input name="type" id="type1b" autocomplete="off" value="google" class="product_change" type="radio"> Google login
									</label>
								</div>
								
							</div>
                            <form id="loginform" role="form" class="form-signin" method="POST">
                                <fieldset>
                                    <div id="changeform">
                                        <div class="form-group">
                                            <labe for="username">RUT</labe>
                                            <input name="username" id="username" type="text" autofocus="" placeholder="RUT" class="form-control" >
										</div>
                                        <div class="form-group">
                                            <labe for="password">Password</labe>
                                            <input name="password" id="password" type="password" placeholder="Password" class="form-control">
										</div>
                                        <input name="logintype" id="logintype" type="hidden" value="metadocument">
                                        <input name="redirecturi" id="redirecturi" type="hidden" value="validate-gapp" class="form-control" >
									</div>
                                    <div class="text-center">
                                        <div class="btn-group">
											
                                            <button class="btn btn-danger btn-block" id="submit" type="submit">Ingresar</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
                <div class="col-md-4"></div>
			</div>
		</div>
	</body>
<?php require_once('./views/foot.php'); ?>
</html>



