<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar / Crear Metadatos</h4>
			</div>
			<div class="modal-body">
				<form id="metaDAtaForm">
					<div class="form-group">
						<label for="description">Descripción</label>
						<input type="text" class="form-control" id="description" name="description" placeholder="Descripción">
					</div>
					<div class="form-group">
						<label for="content">Contenido</label>
						<input type="text" class="form-control" id="content" name="content" placeholder="Contenido">
					</div>

					

            <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
           

					

					<input type="text"  id="fileId" name="fileId" value="">
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" id="save">Guardar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--button type="button" class="btn btn-primary" id="save">Guardar</button-->
			</div>
		</div>
	</div>
</div>