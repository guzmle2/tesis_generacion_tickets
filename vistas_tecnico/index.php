<?php include '../Back-End/Presentador/TicketConsultarTecnicoPresentador.php'; 
require_once '../Back-End/Presentador/EntidadUsuario.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
    <script type="text/javascript">
        function mostrar() {
            if (document.getElementById('oculto').style.display == 'block') {
                document.getElementById('oculto').style.display = 'none';
                document.getElementById('textCambia').innerHTML = "Generar ticket <i class='mdi-alert-warning right'></i>";

            } else {
                (document.getElementById('oculto').style.display = 'block');
                document.getElementById('textCambia').innerHTML = "Ocutar <i class='mdi-alert-warning right'></i>";
            }
        }
    </script>
    <header>

    <header>
        <ul id="dropdownUsuario" class="dropdown-content">
            <li><a href="UsuarioEditar.php">Editar Info</a>
            </li>
        </ul>
        <nav>
            <div class="nav-wrapper ">
                <a href="#!" class="brand-logo">Tickets</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdownUsuario">Usuario<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    </li>
                    <li><a href="../index.php"><i class="mdi-content-send right"></i>Salir</a>
                    </li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="../index.php"><i class="mdi-content-send right"></i>Salir</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    </header>
    <section class="container section">
        <div class="row">
            <div class="col s12   waves-color-demo">
                <div id="popout" class="section scrollspy">
                    <h4>Tecnico</h4>
                    <p class="caption sombra">Estatus de incidencias. </p>
                    <ul class="collapsible popout collapsible-accordion" data-collapsible="accordion" active>
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-alert-warning"></i>Tickets nuevos</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="asunto">Id</th>
                                            <th data-field="asunto">Usuario</th>

                                            <th data-field="asunto">Gerencia</th>
                                            <th data-field="asunto">Asunto</th>
                                            <th data-field="asunto">Detalle</th>
                                            <th data-field="prioridad">Prioridad</th>
                                            <th data-field="estado">Estatus</th>
                                            <th data-field="comentario">DetalleTecnico</th>
                                            <th data-field="sybm"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($TecnicoTickets as $item): ?>
                                        <?php if($item[ 'estado']=='ABIERTO' ){?>
                                        <tr>

                                            <td>
                                                <?php echo $item[ 'id'] ?>
                                            </td>
                                            <td>
                                                <?php $usuario= Usuario::buscarPorId($item[ 'id_usrCreador']); echo $usuario->getCorreo(); ?>
                                            </td>

                                            <td>
                                                <?php echo $item[ 'gerencia'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item[ 'asunto'] ?>
                                            </td>

                                            <td>
                                                <?php echo $item[ 'detalle'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item[ 'prioridad'] ?>
                                            </td>
                                            <form action="../Back-End/Presentador/TicketTecnicoPresentador.php" method="post">
                                                <td>
                                                    <select class="browser-default" name="estatus" required>
                                                        <option value="" disabled selected>Seleccione estatus</option>
                                                        <!-- <option value="PENDIENTE">PENDIENTE</option>-->
                                                        <option value="CERRADO">CERRADO</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea id="detalleEstado" class="materialize-textarea" length="120" name="detalleEstado" required></textarea>
                                                </td>
                                                <td>
                                                    <input id="id_tickets" type="hidden" class="validate" name="id_tickets" value="<?php echo $item['id'];?>">
                                                    <button class="waves-effect waves-red btn-large waves-color-demo" type="submit" name="action">Guardar
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>

                                        <?php } endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>





                    </ul>
                </div>

                <br/>
                <br/>
            </div>
        </div>
    </section>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Tickets</h5>
                    <p class="grey-text text-lighten-4">Sistema automotizado  para soporte tecnico</p>
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
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>