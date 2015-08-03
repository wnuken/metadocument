<div class="row">
	<?php
			if(is_array($folderList)): ?>

	<div class="col-md-2 hidden-xs">
			<div class="col-md-12 img-thumbnail">
			<?php foreach($folderList as $key => $file): ?>

				<div class="row" id="generalfolder">
				<a href="javascript:void(0);" target="_blank" class="text-center" data-g-id="<?php print $file['id']; ?>">
				<div class="col-md-3">
				<img class="img-thumbnail" 
				src="./img/carpetas.png" 
				data-mime="<?php print $file['mimeType']; ?>" 
				alt="<?php print $file['title']; ?>" 
				title="<?php print $file['title']; ?>">
				</div>
				<div class="col-md-9">
				<h5 >
						<!--img src="<?php print $file['icon']; ?>" 
						alt="<?php print $file['mimeType']; ?>" 
						title="<?php print $file['mimeType']; ?>"-->
						<?php print substr($file['title'], 0, 20); ?>
				</h5>
				</div>
				</a>
			</div>

		<?php endforeach;
			
		 ?>

			</div>
		</div>
		<?php 
			endif;
		 ?>


	<div class="col-md-10">
		<?php 
		if(is_array($filesList)):
			foreach($filesList as $key => $file):
				 ?>
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 multielemt">
				<div class="toelement">
				<img style="max-height: 81%" class="img-thumbnail" 
				src="<?php print $file['image']; ?>" 
				data-mime="<?php print $file['mimeType']; ?>" 
				alt="<?php print $file['title']; ?>" 
				title="<?php print $file['title']; ?>">
				<h5 class="hidden-xs">
					<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
						<img src="<?php print $file['icon']; ?>" 
						alt="<?php print $file['mimeType']; ?>" 
						title="<?php print $file['mimeType']; ?>">
						<?php print substr($file['title'], 0, 20); ?>
					</a>
				</h5>
				</div>
				<div class="fromelement" style="display:none;">
					
				

				<?php 
				if(isset($file['exportLinks'])){
					foreach($file['exportLinks'] as $keyb => $exportlink){ 
						print "<div id='exportlink'><a href='" . $exportlink . "'><img width='16' src='./img/icon/" . $keyb . "'></a> </div>";
					} 
				}
				?>

				<div class="hidden-xs">
					<?php 
					print "<small>Emisión: " . date('Y-m-d h:i:s a',strtotime($file['createdDate'])) . "</small><br />"; 
					print "<small>Actualización: " . date('Y-m-d h:i:s a',strtotime($file['modifiedDate'])) . "</small> <br />";
					print "<small>descripción: " . $file['description'] . "</small>";

					?>
				</div>

				<div class="hidden-xs">
					<button type="button" class="btn btn-danger btn-xs buttonProperies" data-toggle="modal" data-target="#myModal" data-document-id="<?php print $file['id']; ?>">
						<i class="glyphicon glyphicon-list-alt"></i> Edición
					</button>
				</div>

				</div>

			</div>

			<?php 
			endforeach;
			endif;
			?>

		</div>
		

	</div>