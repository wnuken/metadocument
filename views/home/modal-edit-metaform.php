<div class="modal fade" id="createFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Metadados de carpeta</h4>
			</div>
			<div class="modal-body" id="createFormBody">

				<form id="createForm" method="">
					<div class="form-group">
					<!-- id carpeta -->
						<input type="hidden" class="form-control" id="id" name="id" value="<?php print $idFolder; ?>">
					</div>
					<div class="form-group">
					<!-- id funcion -->
						<input type="hidden" class="form-control" id="posid" name="posid" value="1">
					</div>
					<div class="form-group">
						<label for="name">Nombre Campo</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nombre Campo">
					</div>
					<div class="form-group">
						<label for="type">Tipo de dato</label>
						<select class="form-control" id="type" name="type">
						<option value="text" selected="selected">Texto</option>
							<option value="date">Fecha</option>
							<option value="number">Número</option>
						</select>
					</div>
					
					<button type="button" class="btn btn-primary" id="add">Agregar Campo</button>
				</form>

				<h3>Metadatos</h3>
				<div id="createFormMessages">
				
				</div>


			</div>
			<div class="modal-footer">
				<!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="savedata">Guardar cambios</button-->
			</div>
		</div>
	</div>
</div>