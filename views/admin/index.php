<div ng-app="adminUserApp" >
<div ng-controller="adminUserController">

<div class="col-md-12 col-lg-12">

  <div class="row">
    <div class="panel panel-primary" id="ListUser">
      <div class="panel-heading">Listado de usuarios</div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped" id="tableUser" ng-show="formVisivility">
          <tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Correo</th><th>ID Carpeta</th><th>Acciones</th></tr>
           

           <tr ng-repeat="user in AdminUsers | orderBy: 'Name'">
                <td>{{user.Id}}</td>
                <td>{{user.User}}</td>
                <td>{{user.Name}}</td>
                <td>{{user.Email}}</td>
                <td>{{user.FolderRoot}}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-info" id="editUser" data-edit="{{user.id}}"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button type="button" class="btn btn-sm btn-danger" id="deleteUser" data-edit="{{user.id}}"><i class="glyphicon glyphicon-trash"></i></button>   
                </td>
              </tr>




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
        <form id="createUserForm" name="createUserForm">
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
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.$pristine && createUserForm.user.$error.required}">
            <label for="user">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" ng-model="newUser.user" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.$pristine && createUserForm.user.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.$pristine && createUserForm.pass1.$error.required}">
            <label for="pass1">Contraseña</label>
            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Contraseña" ng-model="newUser.pass1" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.$pristine && createUserForm.pass1.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.$pristine && createUserForm.pass2.$error.required, metawarning: createUserForm.pass2 == createUserForm.pass1}">
            <label for="pass2">Repetir Contraseña</label>
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Contraseña" ng-model="newUser.pass2" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.$pristine && createUserForm.pass2.$error.required"></span>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true" ng-show="!createUserForm.$pristine && createUserForm.pass2 == createUserForm.pass1"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.$pristine && createUserForm.name.$error.required}">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" ng-model="newUser.name" ng-model="newUser.name" required>
            <span ng-show="!createUserForm.$pristine && createUserForm.name.$error.required">El nombre es requerido.</span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.$pristine && createUserForm.email.$error.required, metawarning: createUserForm.email.$error.email}">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" ng-model="newUser.email" required>
            <span ng-show="!createUserForm.$pristine && createUserForm.email.$error.required">El correo es requerido.</span>
            <span ng-show="!createUserForm.$pristine && createUserForm.email.$error.email">Por favor escriba un correo valido</span>
          </div>
          <div class="form-group has-feedback">
            <label for="folder_id">ID Carpeta</label>
            <input type="text" class="form-control" id="folder_id" name="folder_id" placeholder="ID Carpeta" ng-model="newUser.folder_id" required>
            <span ng-show="!createUserForm.$pristine && createUserForm.folder_id.$error.required">El id de carpeta es requerido.</span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="createUserFormButton"><i class="glyphicon glyphicon-import"></i> Agregar</button>
        <button type="button" ng-click="Save()" class="btn btn-default" ng-disabled="!createUserForm.$valid">Enviar</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>