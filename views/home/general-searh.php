<div class="row">
<?php  if(!isset($filesList['parents']) || empty($filesList['parents'])){
	$filesList['parents'] = $_SESSION['arrayFolder']['0'];
}

	if(is_array($folderList)): ?>
	<div class="row">
	<div id="thisForder" data-parent="<?php print $filesList['parents']; ?>"></div>
		<div class="col-md-12 hidden-xs">
			<?php foreach($folderList as $key => $file):
			if(is_numeric($key)):
				?>
			<div class="col-sm-2 col-md-3 col-lg-2">
				<div id="generalfolder" style="width:100%">
					<a href="javascript:void(0);" class="text-center" onclick="datasearhGD('<?php print $file['id']; ?>', this);">
						<div class="img-thumbnail" style="width:100%">
							<div style="float:left;">
								<img style="width:40px;"
								src="./img/icon/folder.png" 
								data-mime="<?php print $file['mimeType']; ?>" 
								alt="<?php print $file['title']; ?>" 
								title="<?php print $file['title']; ?>">
							</div>
							<div style=" height: 26px; overflow:hidden;">
								<h5 class="hidden-sm" >
									<?php print substr($file['title'], 0, 20); ?>
								</h5>
							</div>
						</div>
						<p></p>
					</a>
				</div>
			</div>
			<?php 
			endif;
			endforeach;
			?>


		</div>
	</div>
	<?php 
	endif;
	?>
	<br />
	<div class="row">
		<div class="col-md-12" id="list-document">
			<?php 
			require_once('./views/home/general-searh-page.php');
			?>
		</div>

	</div>
</div>