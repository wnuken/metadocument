<div class="row">
	<div class="col-md-9">
		<?php 
		if(is_array($filesList)):
			foreach($filesList as $key => $file):
				?>
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">

				<img class="img-thumbnail" 
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

			<?php 
			endforeach;
			endif;
			?>

		</div>
		<div class="col-md-3 hidden-xs">
			<div class="col-md-12 img-thumbnail">
				<h4>Información</h4>
				<a href="https://doc-00-as-docs.googleusercontent.com/docs/securesc/fun9qli7djcr0e7j91a1ikbrt4ao47bp/mf450vngopttngcdm3ufnoneocnia55s/1438365600000/18317237770757400748/11374715647261212813/0B6Uf2s-14mS6SnQyZ0hwNzNrODg?e=download&amp;gd=true&amp;access_token=ya29.wQEPbg8A3cQ2y74_u0OtN11H8ReBO_XaY0zkJXh42FkEZGfHNMPB2oR3bC5-fHajsTy8"><img width="64" src="./img/icon/pdf.png"></a>
			</div>
		</div>

	</div>