<div class="modal fade" id="metaDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar / Crear Metadatos</h4>
			</div>
			<div class="modal-body">
				<div id="MetaDataError"></div>
				<form id="metaDataForm">
					<!--div class="form-group">
						<label for="description">Descripción</label>
						<input type="text" class="form-control" id="description" name="description" placeholder="Descripción">
					</div-->
					<textarea name="editor1" id="editor1" rows="10" cols="40">
					</textarea>
					<input type="hidden"  id="fileId" name="fileId" value="">
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" id="save">Guardar</button>
			</div>
		</div>
	</div>
</div>