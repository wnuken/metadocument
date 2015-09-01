<div class="modal fade" id="modalAddFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva carpeta</h4>
      </div>
      <div class="modal-body">
      <div id="addFolderError"></div>
      <form id="addfolderForm">
          <div class="form-group">
            <label for="title">Nombre de carpeta</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nombre de carpeta">
          </div>
          <!--button type="submit" class="btn btn-default" id="save">Guardar</button-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="addFolderBt">Crear</button>
      </div>
    </div>
  </div>
</div>