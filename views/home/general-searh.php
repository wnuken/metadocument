<table class="table table-bordered table-striped js-options-table">
	<tr>
		<th>#</th>
		<th>Título</th>
		<th>Descarga</th>
		
		<th class="hidden-xs">Información</th>
		<th class="hidden-xs">Propiedades</th>
	</tr>
	<?php 
	if(is_array($filesList)):
		foreach($filesList as $key => $file):
	?>
	<tr>
		<th scope="row">
			<?php print ($key + 1); ?>
		</th>
		<td>
			<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
				<div>
					<img src="<?php print $file['image']; ?>" alt="<?php print $file['mimeType']; ?>" title="<?php print $file['title']; ?>">
				</div>
				<h5 class="hidden-xs">
					<img src="<?php print $file['icon']; ?>" alt="<?php print $file['mimeType']; ?>" title="<?php print $file['mimeType']; ?>">
					<?php print $file['title']; ?>
				</h5>
			</a>
		</td>
		<td>
			<?php 
			if(isset($file['exportLinks'])){
				foreach($file['exportLinks'] as $keyb => $exportlink){ 
					print "<div class='col-sm-12 col-md-4 col-lg-4' style='margin-bottom: 5px;'><a href='" . $exportlink . "'><img width='64' src='./img/icon/" . $keyb . "'></a> </div>";
				} 
			}
			?>
			
		</td>
		<td class="hidden-xs">
			<?php 
			print "<h4>Emisión: " . date('Y-m-d h:i:s a',strtotime($file['createdDate'])) . "</h4>"; 
			print "<h4>Actualización: " . date('Y-m-d h:i:s a',strtotime($file['modifiedDate'])) . "</h4>";
			print "<h4>descripción: " . $file['description'] . "</h4>";

			?>
		</td>
		
		<td class="hidden-xs">
			<button type="button" class="btn btn-primary btn buttonProperies" data-toggle="modal" data-target="#myModal" data-document-id="<?php print $file['id']; ?>">
				<i class="glyphicon glyphicon-list-alt"></i> Edición
			</button>
		</td>
	</tr>
	<?php 
		endforeach;
	endif;
	?>
</table>