<?php if(isset($_SESSION) ){session_destroy();} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
    <header>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center"><h9>Sistema automotizado para soporte tecnico INCE</h9></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="informacion.html">Proyecto</a></li>
        <li><a href="Flujograma.html">Flujo Grama</a></li>
      </ul>
    </div>
  </nav>
    </header>
    <section class="container section ">
        <div class="row">
            <div class="col s6 offset-s3 center waves-color-demo" style="padding:20px;">
                <div class="contenedorLogin">
                    <form action="Back-End/Presentador/indexPresentador.php" method="post" onsubmit="return valida(this)">
                        <h4 style="color:black;" align="center">INGRESAR</h4>
                        <br>
                        <div class="row ">
                            <div class="input-field">
                                <input id="email" type="email" name="email" class="validate" required>
                                <label for="email">Correo (@email)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input id="password" type="password" name="password" class="validate" required>
                                <label for="password">Clave</label>
                            </div>
                        </div>
                        <button class="waves-effect waves-red btn-large waves-color-demo" type="submit" name="action">Ingresar
                            <i class="mdi-content-send right"></i>
                        </button>
                    </form>
                      <br>
                       <div style="  font-size: 74%; color:red;"> ** De no estar registrado, ingrese su correo y cualquier caracter para continuar al registro</div>
                    <div style="color: red;">
                        <?php if (isset($_GET[ "errorusuario"])) { if ($_GET[ "errorusuario"]=="si" ) { echo '*Clave incorrecta*'; } } ?>
                        <div style="color: blue;">
                            <?php if (isset($_GET[ "usuarionuevo"])) { if ($_GET[ "usuarionuevo"]=="si" ) { echo '*Ingrese con su nueva clave*'; } } ?>
                        </div>

                    </div>
                </div>
            </div>
    </section>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Tickets</h5>
                    <p class="grey-text text-lighten-4">Sistema automotizado para soporte tecnico INCE</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text"> </h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Machuca Rita</a>
                        </li>
                        <li><a class="grey-text text-lighten-3" href="#!">Fernandez Ynver</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2015 Copyright
                <a class="grey-text text-lighten-4 right" href="#!"> </a>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>