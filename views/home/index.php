<?php
//getSession()->set('name', array(1,2));



$var = getSession()->get('name');
print_r($var);

//getSession()->set('name', '');
// getSession()->end('home');


?>

<div class="">
	<div id="progress" class="col-md-12" style="display:none;">
		<div class="loading-ms text-center">
			<img src="./img/loading-ms.gif">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div id="addFolder" data-parent="<?php print $filesList['parents']; ?>"	data-token="<?php print $filesList['pageToken']; ?>"></div>
					
					<div class="btn-group btn-group-xs visible-xs" style="height: 18px;" role="group" aria-label="...">

						<div class="btn-group btn-group-xs" role="group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Explorar
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<?php 
								if(is_array($folderList)):
									foreach($folderList as $key => $folder):
										if(is_numeric($key)):
											?>
										<li>
											<a href="/<?php print $folder['id']; ?>" onclick="loadigPage();">
												<i class="glyphicon glyphicon-folder-open"></i> 
												<?php print $folder['title']; ?>
											</a>
										</li>
										<?php

										endif;
										endforeach;
										endif; ?>




									</ul>
								</div>
								<?php if($RestParams != ''): ?>
									<button type="button" class="btn btn-primary" onclick="window.history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Atras</button>
								<?php endif; ?>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddFolder">
									<i class="glyphicon glyphicon-folder-open"></i> <strong>+</strong>
								</button> 
								<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-open"></i> </button>
							</div>




							<div class="btn-group hidden-xs" role="group" aria-label="...">

								<div class="btn-group" role="group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Explorar
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<?php 
								if(is_array($folderList)):
									foreach($folderList as $key => $folder):
										if(is_numeric($key)):
											?>
										<li>
											<a href="/<?php print $folder['id']; ?>" onclick="loadigPage();">
												<i class="glyphicon glyphicon-folder-open"></i> 
												<?php print $folder['title']; ?>
											</a>
										</li>
										<?php

										endif;
										endforeach;
										endif; ?>
									</ul>
								</div>
								<?php if($RestParams != ''): ?>
									<button type="button" class="btn btn-primary" onclick="window.history.back()"><i class="glyphicon glyphicon-arrow-left"></i> Atras</button>
								<?php endif; ?>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddFolder">
									<i class="glyphicon glyphicon-folder-open"></i> Nueva Carpeta
								</button> 
								<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-open"></i> Subir archivo</button>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFormModal">
								<i class="glyphicon glyphicon-indent-left"></i> Metadata
								</button>
							</div>





						</div> <!-- panel-heading -->
						<div id="collapseNews" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

								<div class="row">


							<!--div class="col-md-12">
								<ol class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li><a href="#">Library</a></li>
									<li class="active">Data</li>
								</ol>
							</div-->
							<div class="col-md-12" id="generalsearhresult">
								<?php require_once('./views/home/general-searh.php'); ?>
							</div>
						</div>
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php require_once('./views/home/modal-meta-edition.php'); ?>		
	</div>
	<div class="row">
		<?php require_once('./views/home/modal-add-folder.php'); ?>		
	</div>
	<div class="row">
		<?php require_once('./views/home/modal-edit-metaform.php'); ?>		
	</div>


</div>