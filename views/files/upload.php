
<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
				</div>

				<div class="panel-body">
						
			

<form id="uploadFileForm" enctype="multipart/form-data">
	<div class="form-group">
		<label for="filename">Archivo</label> <!-- multiple="true" -->
		<span class="btn btn-danger btn-file">Buscar archivo ...
		<input type="file"  class="file" id="filename" name="filename" placeholder="Archivo">
		</span>
	</div>
	<div class="form-group">
		<label for="title">Nombre</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Nombre">
	</div>
	<div class="form-group">
		<label for="description">Descripción</label>
		<input type="text" class="form-control" id="description" name="description" placeholder="Descripción">
	</div>
	<div class="form-group">
		<label for="parentId">Carpeta</label>
		<select class="form-control" name="parentId" id="parentId">
			<option value="author">Principal</option>
			<option value="type">Hija 1</option>
			<option value="description">Hija 2</option>
			<option value="gen2">Hija 3</option>
		</select>
	</div>
	

	<input type="hidden"  id="fileId" name="fileId" value="">
	<button type="submit" class="btn btn-default" id="save">Subir archivo</button>
</form>
</div>