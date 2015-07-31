<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div style="height:30px;">
						<div class="btn-group col-md-2">
							<button class="btn btn-default btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
								<i class="glyphicon glyphicon-folder-close"></i> Explorar <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" id="generalfolder">
								<!--li><a data-g-id="<?php print $path; ?>" href="javascript:void(0);"><i class="glyphicon glyphicon-folder-open"></i> Principal</a></li-->
								<?php 
								if(is_array($folderList)):
									foreach($folderList as $key => $folder): ?>
								<li>
									<a data-g-id="<?php print $folder['id']; ?>" href="javascript:void(0);">
										<i class="glyphicon glyphicon-folder-open"></i> 
										<?php print $folder['title']; ?>
									</a>
								</li>
								<?php
								$_SESSION['arrayFolder'][] = $folder['id'];
								endforeach;
								endif; ?>
							</ul>
						</div>
						<div class="input-group col-md-4">
							<input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Fecha inicial">
						</div>
					</div>
				</div>
				<div id="collapseNews" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
						
						<div class="row">
							<div id="progress" class="col-md-12" style="display: none;">
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
										<span class="sr-only">100% Complete</span>
									</div>
								</div>
							</div>
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
</div>