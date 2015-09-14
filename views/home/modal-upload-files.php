<div class="modal fade" id="modalUploadFiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivos</h4>
      </div>
      <div class="modal-body">
      <div id="UploadFilesMessages"></div>
      <form id="avanceSearhForm">
          <div class="form-group">
            <label for="title">Subir</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nombre de carpeta">
          </div>
          <!--button type="submit" class="btn btn-default" id="save">Guardar</button-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="UploadFilesButton">Crear</button>
      </div>
    </div>
  </div>
</div>