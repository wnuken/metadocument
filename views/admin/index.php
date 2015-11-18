<div class="col-md-3">
	
	<div class="list-group">
  <a href="./administracion" class="list-group-item active">
    Crear nuevo usuario
  </a>

  <a href="#" class="list-group-item">Segundo Menu</a>
  <a href="#" class="list-group-item">Tercer Menu</a>
  <a href="#" class="list-group-item">Cuarto Menu</a>
</div>

</div>
<div class="col-md-9">
	    <div class="panel panel-primary" id="createUser">
	    <div class="panel-heading">Crear usuario</div>
  <div class="panel-body">
  <div id="createUserMessages"></div>
    <form id="createUserForm" method="">
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
      <!--button type="button" class="btn btn-primary" id="add"><i class="glyphicon glyphicon-import"></i> Agregar Campo</button-->
    </form>
    </div>

  <div class="panel-footer">
    <button type="button" class="btn btn-primary" id="createUserFormButton"><i class="glyphicon glyphicon-import"></i> Agregar</button>
  </div>
  <div id="leftCreateMetaMessages"></div>
  <div class="left-menu-back"></div>

</div></div>