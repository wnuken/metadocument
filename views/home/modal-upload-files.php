<div class="modal fade" id="modalUploadFiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivos</h4>
      </div>
      <div class="modal-body">
        <div id="UploadFilesMessages"></div>
        <form id="uploadFileForm" enctype="multipart/form-data">
          <div class="form-group">
            <label for="filename">Archivo</label> <!-- multiple="true" -->
           
              <!--input type="file"  class="file" id="filename" name="filename" placeholder="Archivo"-->
            <input id="filename" name="filename" type="file" class="file" data-show-upload="false" data-show-caption="true">
          </div>
          <input type="hidden"  id="parentId" name="parentId" value="<?php print $filesList['parents']; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" data-loading-text="Subiendo..." class="btn btn-primary" id="UploadFilesButton">Subir</button>
      </div>
    </div>
  </div>
</div>