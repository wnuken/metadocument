<?php if($_SESSION['userinfo']):
	// $userData = json_decode($_SESSION['userinfo'], true);
	$userData = $_SESSION['userinfo'];
	// print_r($_SESSION);

	?>
	<div class="col-md-3">
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Registro
			</div>
			<div id="collapseNews" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<h3>Te damos la bienvenida: <?php print $userData['name']; ?></h3>
					<img class="img-circle" width="100px" src="<?php print $userData['picture']; ?>">
					<h4>Desde ahora podras gestionar tus archivos con Metadocument</h4>
					<form id="register">
						<input name="folder" id="folder" type="hidden" autofocus="" value="root" >
						<input name="name" id="name" type="hidden" value="<?php print $userData['name']; ?>">
						<input name="email" id="email" type="hidden" value="<?php print $userData['email']; ?>">
						<input name="verified_email" id="verified_email" type="hidden" value="<?php print $userData['verified_email']; ?>">
						<input name="picture" id="picture" type="hidden" value="<?php print $userData['picture']; ?>">
						<input name="id" id="id" type="hidden" value="<?php print $userData['id']; ?>">
						<input name="link" id="link" type="hidden" value="<?php print $userData['link']; ?>">
						<div class="text-center">
							<div class="btn-group">
								
								<button class="btn btn-danger btn-block" id="submit" type="submit">Continuar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
	</div>

	<div id="registerResult"></div>
	<div id="progress" class="col-md-12" style="display:none;">
		<div class="loading-ms text-center">
			<img src="./img/loading-ms.gif">
		</div>
	</div>

<?php endif; ?>