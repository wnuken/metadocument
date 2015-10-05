<div class="panel panel-primary left-menu hidden-element" id="leftCreateForm">
  <div class="panel-heading">Nueva Carpeta</div>
  <div class="panel-body" id="leftCreateFormBody">
    <form id="leftCreateFormForm" method="">
          <div class="form-group">
          <!-- id carpeta -->
            <input type="hidden" class="form-control" id="id" name="id" value="<?php print $idFolder; ?>">
          </div>
          <div class="form-group">
          <!-- id funcion -->
            <input type="hidden" class="form-control" id="posid" name="posid" value="1">
          </div>
          <div class="form-group">
            <label for="name">Nombre MetaDato</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre MetaDato">
          </div>
          <div class="form-group">
            <label for="type">Tipo de dato</label>
            <select class="form-control" id="type" name="type">
            <option value="text" selected="selected">Texto</option>
              <option value="date">Fecha</option>
              <option value="number">Número</option>
            </select>
          </div>
          
          <button type="button" class="btn btn-primary" id="add"><i class="glyphicon glyphicon-import"></i> Agregar Campo</button>
        </form>

        <h3>Metadatos</h3>
        <div id="createFormMessages">
        
        </div>




  </div>
  <div class="panel-footer">
    <button type="button" class="btn btn-default" data-meta-close="left"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
    <button type="button" class="btn btn-primary" id="leftCreateFormButton"><i class="glyphicon glyphicon-floppy-disk"></i> Crear</button>
  </div>
  <div id="leftCreateFormMessages"></div>
  <div class="left-menu-back"></div>
</div>