<div class="modal fade" id="modalAvanceSearh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Busqueda avanzada</h4>
      </div>
      <div class="modal-body">
        <div id="AvanceSearhMessages"></div>
        <form id="AvanceSearhForm">
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
      <div class="modal-footer" style="clear: both;">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="AvanceSearhButton"><i class="glyphicon glyphicon-search"></i> Buscar</button>
      </div>
    </div>
  </div>
</div>