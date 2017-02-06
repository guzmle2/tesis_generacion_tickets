<?php include '../Back-End/Presentador/TicketConsultarPresentador.php';
$_SESSION['admin'] = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="stylesheet" href="../css/style.css">
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
    <section class="container section">
        <div class="row">
            <div class="col s8 offset-s2  waves-color-demo">
                <div id="popout" class="section scrollspy">
                    <h4>Consultor de incidencias</h4>
                    <p class="caption sombra" >Estatus de sus incidencias. </p>
                    <ul class="collapsible popout collapsible-accordion" data-collapsible="accordion">
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-alert-warning"></i>Tickets Abiertas</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="asunto">Num</th>
                                            <th data-field="asunto">Asunto</th>
                                            <th data-field="prioridad">Prioridad</th>
                                            <th data-field="detalle">Detalle</th>
                                            <th data-field="estado">Estatus</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($personajes as $item): ?>
                                        <?php if($item[ 'estado']!='CERRADO' ){?>
                                        <tr>
                                            <td>
                                                <?php echo $item[ 'id'] ?>

                                            </td>
                                            <td>
                                                <?php echo $item[ 'asunto'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item[ 'prioridad'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item[ 'detalle'] ?>
                                            </td>
                                            <td>
                                                <?php echo $item[ 'estado'] ?>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-action-visibility"></i>Tickets cerrados</div>
                            <div class="collapsible-body" style="display: none; padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="asunto">Num</th>
                                            <th data-field="asunto">Asunto</th>
                                            <th data-field="estado">Estatus</th>
                                            <th data-field="estado">Comentario</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($personajes as $items): ?>
                                        <?php if($items[ 'estado']=='CERRADO' ){?>

                                        <tr>

                                            <td>
                                                <?php echo $items[ 'id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $items[ 'asunto'] ?>
                                            </td>
                                            <td>
                                                <?php echo $items[ 'estado'] ?>
                                            </td>
                                            <td>
                                                <?php echo $items[ 'estadoDetalle'] ?>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php if (isset($_GET[ "modificado"])) { if ($_GET[ "modificado"]=="si" ) { echo '*Sus datos fueron modificados exitosamente*'; }else{ echo '*Error al actualizar sus datos intente mas tarde*'; } } ?>
                <button class="waves-effect waves-red btn-large waves-color-demo" onclick="mostrar()" id="textCambia" name="action">Generar ticket
                    <i class="mdi-alert-warning right"></i>
                </button>


                <br/>
                <br/>
                <form action="../Back-End/Presentador/TicketsCrearPresentador.php" method="post" id='oculto' style='display:none;'>
                    <div class="contenedorLogin">
                        <div class="row">
                            <label>Prioridad</label>
                            <select class="browser-default" name="prioridad" required>
                                <option value="" disabled selected>Escoga la prioridad</option>
                                <option value="BAJA">BAJA</option>
                                <option value="MODERADA">MODERADA</option>
                                <option value="ALTA">ALTA</option>
                            </select>
                        </div>

                        <div class="row">
                            <label>Sistema Operativo</label>
                            <select class="browser-default" name="SO" required>
                                <option value="" disabled selected>Escoga Sistema Operativo</option>
                                <option value="Linux">Linux</option>
                                <option value="Window">Window</option>
                                <option value="iOS">iOS</option>
                            </select>
                        </div>

                        <div class="row">
                            <label>Gerencia</label>
                            <select class="browser-default" name="gerencia" required>
                                <option value="" disabled selected>Escoga gerencia</option>
                                <option value="Informatica">Informatica</option>
                                <option value="Planificacion">Planificacion</option>
                                <option value="Finanzas">Finanzas</option>
                                <option value="Tributo">Tributo</option>
                                <option value="Infraestructura">Infraestructura</option>
                                <option value="RRHH">RRHH</option>
                                <option value="Informacion y relaciones">Informacion y relaciones</option>
                                <option value="Cooperacion Nacional e Internacional">Cooperacion Nacional e Internacional</option>
                                <option value="INCE Militar">INCE Militar</option>
                                <option value="Formacion profesional">Formacion profesional</option>
                                <option value="Auditoria">Auditoria</option>
                                <option value="Consultoria">Consultoria</option>
                                <option value="Presidencia">Presidencia</option>

                                <option value="Direccion ejecutiva">Direccion ejecutiva</option>

                            </select>
                        </div>
                        <div class="row ">
                            <div class="input-field">
                                <input id="asunto" type="text" class="validate" length="10" name="asunto" required>
                                <label for="asunto">Asunto</label>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="input-field col s12">
                                <textarea id="detalle" class="materialize-textarea" length="120" name="detalle" required></textarea>
                                <label for="detalle">Detalle</label>
                            </div>
                        </div>
                        <button class="waves-effect waves-red btn-large waves-color-demo " type="submit" name="action">Generar
                            <i class="mdi-alert-warning right"></i>
                        </button>
                    </div>
                </form>

                <div style="color: #ffffff;">
                    <?php if (isset($_GET[ "TicketGenerado"])) { if ($_GET[ "TicketGenerado"]=="si" ) { echo '*Su ticket fue generado con exito*'; }else{ echo '*Error en generar ticket intente mas tarde*'; } } ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="page-footer ">
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>