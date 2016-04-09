<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<tr>
			<?php 
			foreach ($resultReport['titles'] as $key => $value) {
				print '<th class="info">' . $value . '</th>'; 
			}
			?>
		</tr>
		<?php 
		$compr = 0;
		foreach ($resultReport['files'] as $key => $file) {
			?>
			<tr>
				<?php foreach ($file as $key1 => $value) {
					$compr = $key1;
					print '<td>' . $value . '</td>'; 

				}

				if($compr == 0){
					foreach ($resultReport['titles'] as $key => $value) {
						 if($key > 0)
							print '<td></td>'; 
					}
				}

				?>
			</tr>
			<?php
		}
		?>
	</table>
</div>