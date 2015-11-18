
<div  class="metadocument-menu">
<div class="btn-group btn-group" style="top: 2px;
left: 3px;" role="group" aria-label="...">
<div class="btn-group btn-group" role="group" style="top: 8px;">
    <button type="button" class="btn btn-default" onclick="location.reload();">
        <img src="./img/logo-vt.png" style="height: 18px;">
    </button>

    <button type="button" class="btn btn-danger" data-meta-toggle="left" data-target="#leftNewFolder">
        <i class="glyphicon glyphicon-folder-open"></i> + <small class="hidden-xs hidden-sm"> Nueva </small>
    </button> 

    <!--button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAddFolder">
        <i class="glyphicon glyphicon-folder-open"></i> + <small class="hidden-xs hidden-sm"> Nueva </small>
    </button-->

    <button type="button" class="btn btn-danger" data-meta-toggle="left" data-target="#leftCreateMeta">
        <i class="glyphicon glyphicon-indent-left"></i><small class="hidden-xs hidden-sm"> Metadatos</small>
    </button>

    <!--button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createFormModal">
        <i class="glyphicon glyphicon-indent-left"></i><small class="hidden-xs hidden-sm"> Metadatos</small>
    </button-->

     <button type="button" class="btn btn-danger" onclick="AvanceSearhgetForm()" data-meta-toggle="left" data-target="#leftAvanceSearh">
       <i class="glyphicon glyphicon-zoom-in"></i><small class="hidden-xs hidden-sm"> Busqueda Avanzada</small>
   </button>


    <!--button type="button" class="btn btn-danger" onclick="AvanceSearhgetForm()" data-toggle="modal" data-target="#modalAvanceSearh">
       <i class="glyphicon glyphicon-zoom-in"></i><small class="hidden-xs hidden-sm"> Busqueda Avanzada</small>
   </button-->


   <button type="button" class="btn btn-danger" onclick="searchFormVisible();" >
       <i class="glyphicon glyphicon-search"></i><small class="hidden-xs hidden-sm"> Buscar</small>
   </button>
   <div class="btn-group btn-group" role="group">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="glyphicon glyphicon-user"></i> 
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
                    <li><a href="<?php print $userlink; ?>" ><?php print $username; ?></a></li>
                            <!--li><a href="#">Acciones</a></li-->
                            <?php if($userRol == 1): ?>
                            <li><a href="./administracion">Configuración</a></li>
                        <?php endif; ?>
                            <li class="divider"></li>
                                <li><a href="./destroy"><i class="glyphicon glyphicon-share"></i> Salir</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="">
                    
                    <form class="hidden formSearh" role="search" id="drivesearh">
                        <div class="form-group input-group">
                            <input type="text" class="form-control" name="query" id="query" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" id="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>


            </div>