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

foreach ($resultReport['files'] as $key => $file) {
	?>
	<tr>
	<?php foreach ($file as $key1 => $value) {
	print '<td>' . $value . '</td>'; 

	}
		 ?>
	</tr>
	<?php
}
?>
</table>
</div>