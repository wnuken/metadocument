<div class="panel panel-primary left-menu hidden-element" id="leftCreateMeta">
  <div class="panel-heading">Meta Datos</div>
  <div class="panel-body" id="leftCreateMetaBody">
    <form id="leftCreateMetaForm" method="">
      <div class="form-group">
        <!-- id carpeta -->
        <input type="hidden" class="form-control" id="id" name="id" value="<?php print $filesList['parents']; ?>">
      </div>
      <div class="form-group">
        <!-- id funcion -->
        <input type="hidden" class="form-control" id="posid" name="posid" value="1">
      </div>
      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
      </div>
      <div class="form-group">
        <label for="type">Tipo</label>
        <div class="btn-group" data-toggle="buttons">
          <label class="btn btn-default active">
            <input type="radio" name="type" id="type1" autocomplete="off" checked value="text"> Texto
          </label>
          <label class="btn btn-default">
            <input type="radio" name="type" id="type2" autocomplete="off" value="date"> Fecha
          </label>
          <label class="btn btn-default">
            <input type="radio" name="type" id="type3" autocomplete="off" value="number"> Número
          </label>
        </div>
      </div>
      <!--button type="button" class="btn btn-primary" id="add"><i class="glyphicon glyphicon-import"></i> Agregar Campo</button-->
    </form>
  </div>
  <div class="panel-footer">
    <button type="button" class="btn btn-default" data-meta-close="left"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
    <button type="button" class="btn btn-primary" id="leftCreateMetaButton"><i class="glyphicon glyphicon-import"></i> Agregar</button>
  </div>
  <div id="leftCreateMetaMessages"></div>
  <div class="left-menu-back"></div>
</div>