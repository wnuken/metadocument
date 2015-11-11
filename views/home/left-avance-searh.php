<div class="panel panel-primary left-menu hidden-element" id="leftAvanceSearh">
  <div class="panel-heading">Meta Datos</div>
  <div class="panel-body" id="leftAvanceSearhBody">
    <form id="leftAvanceSearhForm" method="">
       <div id="AvanceSearhDates">
          </div>
          <!--button type="submit" class="btn btn-default" id="save">Guardar</button-->
          <div class="form-group">
            <div id="text_button" data-toggle="popover"></div>
          </div>
          <div class="page-header">Criterios generales de busqueda</div>
          <div class="form-group">
            <label for="title">Nombre del archivo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nombre del archivo"> 
          </div>
          <div class="form-group">
            <label for="content">MetaDatos</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="MetaDatos">
          </div>
    </form>
  </div>
  <div class="panel-footer">
    <button type="button" class="btn btn-default" data-meta-close="left"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
    <button type="button" class="btn btn-primary" id="leftAvanceSearhButton"><i class="glyphicon glyphicon-search"></i> Buscar</button>
  </div>
  <div id="leftAvanceSearhMessages"></div>
  <div class="left-menu-back"></div>
</div>