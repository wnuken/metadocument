
<div class="col-md-12 col-lg-12" ng-app="adminUserApp">

  <div class="row">
    <div class="panel panel-primary" id="ListUser" ng-controller="adminUserController">
    <ul>
    <li ng-repeat="user in users | orderBy: 'name'" class="list-group-item">El alumno {{user.id}} esta en el curso {{user.name}}</li>
    </ul>
      <div class="panel-heading">Listado de usuarios</div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped">
          <tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Correo</th><th>ID Carpeta</th><th>Acciones</th></tr>
            <?php foreach ($adminUsers as $key => $value) : ?>
              <tr>
                <td><?php  print $value->getId() ?></td>
                <td><?php  print $value->getUser() ?></td>
                <td><?php  print $value->getName() ?></td>
                <td><?php  print $value->getEmail() ?></td>
                <td><?php  print $value->getFolderRoot() ?></td>
                <td>
                  <button type="button" class="btn btn-sm btn-info" id="editUser" data-edit="<?php  print $value->getId() ?>"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button type="button" class="btn btn-sm btn-danger" id="deleteUser" data-edit="<?php  print $value->getId() ?>"><i class="glyphicon glyphicon-trash"></i></button>   
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
      <div class="panel-footer">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showNewUser"><i class="glyphicon glyphicon-import"></i> Nuevo Usuario</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="showNewUser" tabindex="-1" role="dialog" aria-labelledby="Nuevo Usuario">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="createUser">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Crear Usuario</h4>
      </div>
      <div class="modal-body">
        <div id="createUserMessages"></div>
        <form id="createUserForm" method="">
        <div class="form-group">
            <label for="rol">Rol</label>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-default active">
                <input type="radio" name="rol" id="type1" autocomplete="off" checked value="2"> Usuario
              </label>
              <label class="btn btn-default">
                <input type="radio" name="rol" id="type2" autocomplete="off" value="1"> Administrador
              </label>
              <label class="btn btn-default">
                <input type="radio" name="rol" id="type3" autocomplete="off" value="3"> Gestión
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="user">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
          </div>
          <div class="form-group">
            <label for="pass1">Contraseña</label>
            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <label for="pass2">Repetir Contraseña</label>
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="email">Correo</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Correo">
          </div>
          <div class="form-group">
            <label for="folder_id">ID Carpeta</label>
            <input type="text" class="form-control" id="folder_id" name="folder_id" placeholder="ID Carpeta">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="createUserFormButton"><i class="glyphicon glyphicon-import"></i> Agregar</button>
      </div>
    </div>
  </div>
</div>