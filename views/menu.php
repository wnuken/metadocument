<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand hidden-sm">MetaDocument</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav" id="menunav">
                <li class="active"><a href="./"><i class="glyphicon glyphicon-th"></i> Inicio</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="./variables">
                        <i class="glyphicon glyphicon-indent-left"></i> Variables <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="./variables-busqueda"><i class="glyphicon glyphicon-random"></i> Actualizar criterios de busqueda</a></li>
                        <li><a href="./variables-cliente"><i class="glyphicon glyphicon-th-large"></i> Variables de cliente</a></li>
                        <li><a href="./uploaddoc"><i class="glyphicon glyphicon-th-large"></i> Subir archivo</a></li>
                        
                        <li class="divider"></li>
                        <li class="dropdown-header">Otras opciones</li>
                        <li><a href="./variables-definir-criterios"><i class="glyphicon glyphicon-resize-small"></i> Definir criterios</a></li>
                        <li><a href="./variables-definir"><i class="glyphicon glyphicon-retweet"></i> Definir Variables</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="glyphicon glyphicon-briefcase"></i> Tipos de Consulta <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="./aliados-revision"><i class="glyphicon glyphicon-list"></i> Consultar por Carpeta</a></li>
                        <li><a href="./aliados-enviarpago"><i class="glyphicon glyphicon-briefcase"></i> Consultar por criterios de busqueda</a></li>
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
