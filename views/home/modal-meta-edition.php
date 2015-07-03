<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar / Crear Metadatos</h4>
			</div>
			<div class="modal-body">
				<form id="propertiesForm">
					<div class="form-group">
						<label for="exampleInputEmail1">Tipo</label>
						<select class="form-control" name="key" id="key">
							<option value="author">Autor</option>
							<option value="type">Tipo</option>
							<option value="gen1">Gen1</option>
							<option value="gen2">Gen2</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Valor</label>
						<input type="text" class="form-control" id="value" name="value" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Visibilidad</label>
						
						<select class="form-control" name="visibility" id="visibility">
							<option value="PUBLIC">Publico</option>
							<option value="PRIVATE">Privado</option>
						</select>
					</div>
					<input type="hidden"  id="fileId" name="fileId" value="">
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>