<!DOCTYPE html>
<html lang="es">
<?php require_once('./views/head.php'); ?>
<body role="document">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                        <!--div class="panel-heading">
                            <div class="text-center"><h3 class="panel-title">Iniciar sesión</h3></div>
                        </div-->
                        <div class="panel-body borderContent">
                            <div class="text-center">
                                <div class="row">
                                    <div><img src="./img/logo.png" style="width: 100%;"></div>
                                    <p>Escoja como iniciar sesión: </p>
                                    <div class="visible-lg-block visible-md-block visible-sm-block">
                                        <div id="chagelogin" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-danger active">
                                                <input name="type" id="type1a" autocomplete="off" checked value="metadocument" class="product_change" type="radio"> Metadocument
                                            </label>
                                            <label class="btn btn-danger">
                                                <input name="type" id="type1b" autocomplete="off" value="google" class="product_change" type="radio"> Google login
                                            </label>
                                        </div>
                                    </div>
                                    <div class="visible-xs-block">
                                        <div id="chagelogin" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-danger btn-sm active">
                                                <input name="type" id="type1a" autocomplete="off" checked value="metadocument" class="product_change" type="radio"> Metadocument
                                            </label>
                                            <label class="btn btn-danger btn-sm">
                                                <input name="type" id="type1b" autocomplete="off" value="google" class="product_change" type="radio"> Google login
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="loginform" role="form" class="form-signin" method="POST">
                                <fieldset>
                                    <div id="changeform">
                                        <div class="form-group">
                                            <label for="username">Usuario </label>
                                            <input name="username" id="username" type="text" autofocus="" placeholder="Usuario" class="form-control inputborder" > 
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input name="password" id="password" type="password" placeholder="Password" class="form-control inputborder">
                                        </div>
                                        <input name="logintype" id="logintype" type="hidden" value="metadocument">
                                        <input name="redirecturi" id="redirecturi" type="hidden" value="validate-gapp" class="form-control" >
                                    </div>
                                    <div class="text-center">
                                        <div class="btn-group">

                                            <button class="btn btn-danger btn-block" id="submit" type="submit">Ingresar</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div id="progress" style="display:none;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-xs-6 col-md-6">
            <div class="loading-ms text-center">
                <img src="./img/loading-text.png">
            </div>
            </div>
            <div class="col-md-3"></div>
            </div>
        </div>
        </div>
        <div class="text-center powered-google"><img src="./img/powered_by_google_on_white_hdpi.png"></div>
        
    </body>
    <?php require_once('./views/foot.php'); ?>
    </html>

