<div ng-app="adminUserApp" >
<div ng-controller="adminUserController">
<div class="col-md-12 col-lg-12">
  <div class="row">
    <div class="panel panel-primary" id="ListUser">
      <div class="panel-heading">Listado de usuarios</div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="tableUser" ng-show="formVisivility">
          <tr class="info"><th>ID</th><th>Usuario</th><th>Nombre</th><th>Correo</th><th>ID Carpeta</th><th>Acciones</th></tr>
           <tr ng-repeat="user in AdminUsers | orderBy: $index">
                <td>{{user.Id}}</td>
                <td>{{user.User}}</td>
                <td>{{user.Name}}</td>
                <td>{{user.Email}}</td>
                <td>{{user.FolderRoot}}</td>
                <td>
                <div class="img-thumbnail">
                  <button type="button" class="btn btn-sm btn-info" id="editUser" 
                  data-userindex="{{$index}}"
                  data-userid="{{user.Id}}"
                  data-userlogin="{{user.User}}"
                  data-username="{{user.Name}}"
                  data-useremail="{{user.Email}}"
                  data-userfolder="{{user.FolderRoot}}"
                  data-toggle="modal" 
                  data-target="#showEditUser"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button type="button" class="btn btn-sm btn-danger" id="deleteUser" 
                  data-userindex="{{$index}}"
                  data-userid="{{user.Id}}"
                  data-username="{{user.Name}}"
                  data-toggle="modal" 
                  data-target="#showDeleteUser"><i class="glyphicon glyphicon-trash"></i></button>  
                  </div>
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
        <h4 class="modal-title" id="NewUser"><i class="glyphicon glyphicon-user"></i> Crear Usuario</h4>
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
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.user.$pristine && createUserForm.user.$error.required}">
            <label for="user">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" ng-model="newUser.user" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.user.$pristine && createUserForm.user.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.pass1.$pristine && createUserForm.pass1.$error.required}">
            <label for="pass1">Contraseña</label>
            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Contraseña" ng-model="newUser.pass1" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.pass1.$pristine && createUserForm.pass1.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.pass2.$pristine && createUserForm.pass2.$error.required, metawarning: createUserForm.pass2.$error.passwordVerify }">
            <label for="pass2">Repetir Contraseña</label>
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Contraseña" ng-model="newUser.pass2" required data-password-verify="newUser.pass1">
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.pass2.$pristine && createUserForm.pass2.$error.required"></span>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true" ng-show="!createUserForm.pass2.$pristine && createUserForm.pass2.$error.passwordVerify"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.name.$pristine && createUserForm.name.$error.required}">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" ng-model="newUser.name" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.name.$pristine && createUserForm.name.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.email.$pristine && createUserForm.email.$error.required, metawarning: createUserForm.email.$error.email}">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" ng-model="newUser.email" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.email.$pristine && createUserForm.email.$error.required"></span>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true" ng-show="!createUserForm.email.$pristine && createUserForm.email.$error.email"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !createUserForm.folder_id.$pristine && createUserForm.folder_id.$error.required }">
            <label for="folder_id">ID Carpeta</label>
            <input type="text" class="form-control" id="folder_id" name="folder_id" placeholder="ID Carpeta" ng-model="newUser.folder_id" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!createUserForm.folder_id.$pristine && createUserForm.folder_id.$error.required"></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <button type="button" ng-click="Save()" class="btn btn-primary" ng-disabled="!createUserForm.$valid"><i class="glyphicon glyphicon-import"></i> Agregar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showEditUser" tabindex="-1" role="dialog" aria-labelledby="Editar Usuario">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="updateUser">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EditUser"><i class="glyphicon glyphicon-user"></i> Editar Usuario</h4>
      </div>
      <div class="modal-body">
        <div id="updateUserMessages"></div>
        <form id="updateUserForm" name="updateUserForm">
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
          <div class="form-group has-feedback" ng-class="{ metaerror: !updateUserForm.user.$pristine && updateUserForm.user.$error.required}">
            <label for="user">Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" ng-model="updateUser.user" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.user.$pristine && updateUserForm.user.$error.required"></span>
          </div>

          <div class="form-group" >
            <label for="pass1">Contraseña <small>(Dejar en blanco si no se desea cambiar)</small></label>
            <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Contraseña" ng-model="updateUser.pass1" >
          </div>
          <div class="form-group has-feedback" ng-class="{ metawarning: updateUserForm.pass2.$error.passwordVerify }">
            <label for="pass2">Repetir Contraseña</label>
            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Contraseña" ng-model="updateUser.pass2"  data-password-verify="updateUser.pass1">
            <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.pass2.$pristine && updateUserForm.pass2.$error.passwordVerify"></span>
          </div>

          <div class="form-group has-feedback" ng-class="{ metaerror: !updateUserForm.name.$pristine && updateUserForm.name.$error.required}">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" ng-model="updateUser.name" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.name.$pristine && updateUserForm.name.$error.required"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !updateUserForm.email.$pristine && updateUserForm.email.$error.required, metawarning: updateUserForm.email.$error.email}">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" ng-model="updateUser.email" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.email.$pristine && updateUserForm.email.$error.required"></span>
            <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.email.$pristine && updateUserForm.email.$error.email"></span>
          </div>
          <div class="form-group has-feedback" ng-class="{ metaerror: !updateUserForm.folder_id.$pristine && updateUserForm.folder_id.$error.required }">
            <label for="folder_id">ID Carpeta</label>
            <input type="text" class="form-control" id="folder_id" name="folder_id" placeholder="ID Carpeta" ng-model="updateUser.folder_id" required>
            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" ng-show="!updateUserForm.folder_id.$pristine && updateUserForm.folder_id.$error.required"></span>
          </div>

          <input type="hidden" class="form-control" id="id" name="id" ng-model="updateUser.id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <!--button type="button" class="btn btn-primary" id="createUserFormButton"><i class="glyphicon glyphicon-import"></i> Agregar</button-->
        <button type="button" ng-click="Update()" class="btn btn-primary" ><i class="glyphicon glyphicon-pencil"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="showDeleteUser" tabindex="-1" role="dialog" aria-labelledby="Eliminar Usuario">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="deleteUser">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="RemoveUser"><i class="glyphicon glyphicon-user"></i> Eliminar Usuario</h4>
      </div>
      <div class="modal-body">
        <div id="deleteUserMessages"></div>
        <h4 class="text-center"> Desea eliminar el usuario: <span id="userName"></span></h4>
        <form id="deleteUserForm" name="deleteUserForm">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="Usuario" ng-model="deleteUser.id" required>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cerrar</button>
        <button type="button" ng-click="Delete()" class="btn btn-primary" ><i class="glyphicon glyphicon-pencil"></i> Eliminar</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>