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
						<label for="key">Tipo</label>
						<select class="form-control" name="key" id="key">
							<option value="author">Autor</option>
							<option value="type">Tipo</option>
							<option value="description">Descripción</option>
							<option value="gen2">Gen2</option>
						</select>
					</div>
					<div class="form-group">
						<label for="value">Valor</label>
						<input type="text" class="form-control" id="value" name="value" placeholder="Valor">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Visibilidad</label>
						
						<select class="form-control" name="visibility" id="visibility">
							<option value="PUBLIC">Publico</option>
							<option value="PRIVATE">Privado</option>
						</select>
					</div>
					<input type="hidden"  id="fileId" name="fileId" value="">
					<button type="submit" class="btn btn-default" id="save">Guardar</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--button type="button" class="btn btn-primary" id="save">Guardar</button-->
			</div>
		</div>
	</div>
</div>