<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="btn-group btn-group-lg" style="height: 18px; position:fixed;z-index:10; top: 2px;
            left: 2px;" role="group" aria-label="...">

            <div class="btn-group btn-group-lg" role="group">
                <a href="./" class="navbar-brand hidden-xs" style="position: relative; top: -19px; "><img src="./img/lg-md.png" style="width: 80%;"></a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAddFolder">
                    <i class="glyphicon glyphicon-folder-open"></i> <strong>+</strong><small class="hidden-xs hidden-sm"> Nueva </small>
                </button> 
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createFormModal">
                    <i class="glyphicon glyphicon-indent-left"></i><small class="hidden-xs hidden-sm"> Metadatos</small>
                </button>
                <button type="button" class="btn btn-danger" onclick="AvanceSearhgetForm()" data-toggle="modal" data-target="#modalAvanceSearh">
                 <i class="glyphicon glyphicon-zoom-in"></i><small class="hidden-xs hidden-sm"> Busqueda Avanzada</small>
                </button>
             <div class="btn-group btn-group-lg" role="group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i> <?php print $user; ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <!--li><a href="#">Perfil</a></li>
                            <li><a href="#">Acciones</a></li>
                            <li><a href="./configuracion">Configuración</a></li>
                            <li class="divider"></li-->
                            <li><a href="./destroy">Salir</a></li>
                    </ul>
                </div>

                <button type="button" class="btn btn-danger visible-xs" onclick="searchFormVisible();" >
                 <i class="glyphicon glyphicon-search"></i>
                </button>
                <form class="navbar-form navbar-left hidden-xs" role="search" id="drivesearh">
                            <div class="form-group input-group">
                                <input type="text" class="form-control" name="query" id="query" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" id="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </form>


            </div></div>
               <!--button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button-->
            <!--a href="./" class="navbar-brand hidden-xs hidden-sm" style="position: relative; top: -17px; "><img src="./img/lg-md.png" style="width: 80%;"></a-->
        </div>
        <!--div class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="menunav">
                <li class="hidden-xs"><a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddFolder"><i class="glyphicon glyphicon-folder-open"></i><strong> +</strong> Nueva carpeta</a></li>
                <li class="hidden-xs"><a href="javascript:void(0);" data-toggle="modal" data-target="#createFormModal"><i class="glyphicon glyphicon-indent-left"></i> Crear Metadatos</a></li>
                <li class="hidden-xs"><a href="javascript:void(0);" onclick="AvanceSearhgetForm()" data-toggle="modal" data-target="#modalAvanceSearh"><i class="glyphicon glyphicon-random" ></i> Busqueda Avanzada</a></li>
                <li class="hidden-xs"><a href="javascript:void(0);" data-toggle="modal" data-target="#modalUploadFiles"><i class="glyphicon glyphicon-floppy-open"></i> Subir archivos</a></li-->
                    <!--li class="dropdown" style="float:rigth;">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="glyphicon glyphicon-user"></i> <?php print $user; ?> <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Acciones</a></li>
                            <li><a href="./configuracion">Configuración</a></li>
                            <li class="divider"></li>
                            <li><a href="./destroy">Salir</a></li>
                        </ul>
                    </li-->
                    <!--li>
                        <form class="navbar-form navbar-left" role="search" id="drivesearh">
                            <div class="form-group input-group">
                                <input type="text" class="form-control" name="query" id="query" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="submit" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </li>
                </ul>
            </div--><!--/.nav-collapse -->
        </div>
    </div>
