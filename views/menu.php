<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand hidden-sm" style="position: relative; top: -17px; "><img src="./img/lg-md.png" style="width: 80%;"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="menunav">
                <li class="active"><a href="./"><i class="glyphicon glyphicon-th"></i> Inicio</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="./variables">
                        <i class="glyphicon glyphicon-indent-left"></i> Busqueda <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="./avanced-searh"><i class="glyphicon glyphicon-random"></i> Busqueda Avanzada</a></li>
                        <li><a href="./metadata-searh"><i class="glyphicon glyphicon-th-large"></i> Busqueda Metadatos</a></li>
                        <li><a href="./upload-files"><i class="glyphicon glyphicon-th-large"></i> Subir multiples archivos</a></li>
                    </ul>
                </li>
                <li class="dropdown" style="float:rigth;">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="glyphicon glyphicon-user"></i> <?php print $user; ?> <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Acciones</a></li>
                        <li><a href="./configuracion">Configuración</a></li>
                        <li class="divider"></li>
                        <li><a href="./destroy">Salir</a></li>
                    </ul>
                </li>
                <li>
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
        </div><!--/.nav-collapse -->
    </div>
</div>
