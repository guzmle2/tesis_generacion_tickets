<?php
include '../Back-End/Presentador/TicketConsultarAdminPresentador.php';
require_once '../Back-End/Presentador/EntidadUsuario.php';
$usuariosTecnico= Usuario::buscarPorTipoUsuario( 'tecnico');
$usuariosUsuario= Usuario::buscarPorTipoUsuario( 'usuario');
$_SESSION[ 'admin']= true;
?>

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
            <div class="col s12 waves-color-demo">
                <div id="popout" class="section scrollspy">
                    <h4>Administrador de incidencias</h4>
                    <p class="caption">Estatus de incidencias. </p>
                    <ul class="collapsible popout collapsible-accordion" data-collapsible="accordion">
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-alert-warning"></i>Tickets nuevo</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="asunto">Id</th>
                                            <th data-field="Usuario">Usuario</th>
                                            <th data-field="gerencia">Gerencia</th>
                                            <th data-field="Asunto">Asunto</th>
                                            <th data-field="detalle">Detalle</th>
                                            <th data-field="Prioridad">Prioridad</th>
                                            <th data-field="Estatus">Estatus</th>
                                            <th data-field="tecnico">Tecnico</th>
                                            <th data-field="estado"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($adminTickets as $item): ?>
                                        <?php if(($item[ 'estado']=='NUEVO' )&& $item[ 'id_usrEncargado']=='0' ){?>
                                        <tr>

                                            <td>
                                                <?php echo $item[ 'id'] ?>
                                            </td>
                                            <td>
                                                <?php $usuario=  Usuario::buscarPorId($item[ 'id_usrCreador']); echo $usuario->getCorreo(); ?>
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
                                            <form action="../Back-End/Presentador/TicketAsignaTecnicoPresentador.php" method="post">

                                                <td>
                                                    <?php echo $item[ 'estado'] ?>
                                                </td>
                                                <td>
                                                    <select class="browser-default" name="id_usrEncargado" required>
                                                        <option value="" disabled selected>Tecnico a asignar</option>
                                                        <?php foreach($usuariosTecnico as $items):?>
                                                        <option value="<?php echo $items['id'];?>">
                                                            <?php echo $items[ 'correo'] ?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input id="id_tickets" type="hidden" class="validate" name="id_tickets" value="<?php echo $item['id'];?>">
                                                    <button class="waves-effect waves-red btn-large waves-color-demo " type="submit" name="action">Guardar
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>

                                        <?php } endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li class="">
                            <div class="collapsible-header"><i class="mdi-action-done"></i>Tickets abiertos</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="Num">Num</th>
                                            <th data-field="Usuario">Usuario</th>
                                            <th data-field="Gerencia">Gerencia</th>
                                            <th data-field="Asunto">Asunto</th>
                                            <th data-field="Prioridad">Prioridad</th>
                                            <th data-field="Estatus">Estatus</th>
                                            <th data-field="Tecnico">Tecnico</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($adminTickets as $item): ?>
                                        <?php if(($item[ 'estado']!='CERRADO' )&& $item[ 'id_usrEncargado']!='0' ){?>
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
                                                <?php echo $item[ 'prioridad'] ?>
                                            </td>

                                            <form action="../Back-End/Presentador/EditarEstatusPresentador.php" method="post">
                                            <td>
                                                <select class="browser-default" name="estado" required>
                                                    <option value="ABIERTO" selected>ABIERTO</option>
                                                    <!-- <option value="PENDIENTE">PENDIENTE</option>-->
                                                    <option value="CERRADO">CERRADO</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php $usuario2= Usuario::buscarPorId($item[ 'id_usrEncargado']); echo $usuario2->getCorreo(); ?>
                                            </td>


                                                <td>
                                                    <input id="id_tickets" type="hidden" class="validate" name="id_tickets" value="<?php echo $item['id'];?>">
                                                    <button class="waves-effect waves-red btn-large waves-color-demo " type="submit" name="action">Guardar
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>

                                        <?php } endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </li>


                        <li class="">
                            <div class="collapsible-header"><i class="mdi-action-done-all"></i>Tickets cerrados</div>
                            <div class="collapsible-body" style="display: none;padding: 2%;">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th data-field="Num">Num</th>
                                            <th data-field="Usuario">Usuario</th>
                                            <th data-field="Gerencia">Gerencia</th>
                                            <th data-field="Asunto">Asunto</th>
                                            <th data-field="Gerencia">Gerencia</th>
                                            <th data-field="Prioridad">Prioridad</th>
                                            <th data-field="Estatus">Estatus</th>
                                            <th data-field="Tecnico">Tecnico</th>
                                            <th data-field="estadoDetalle">Detalle-Tecnico</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach($adminTicketsDesc as $itemi): ?>
                                        <?php if( $itemi[ 'estado']=='CERRADO' ){?>
                                        <tr>
                                            <td>
                                                <?php echo $itemi[ 'id'] ?>
                                            </td>
                                            <td>
                                                <?php $usuario= Usuario::buscarPorId($itemi[ 'id_usrCreador']); echo $usuario->getCorreo(); ?>
                                            </td>

                                            <td>
                                                <?php echo $itemi[ 'gerencia'] ?>
                                            </td>
                                            <td>
                                                <?php echo $itemi[ 'asunto'] ?>
                                            </td>
                                            <td>
                                                <?php echo $itemi[ 'detalle'] ?>
                                            </td>
                                            <td>
                                                <?php echo $itemi[ 'prioridad'] ?>
                                            </td>
                                            <td>
                                                <?php echo $itemi[ 'estado'] ?>
                                            </td>
                                            <td>
                                                <?php if ($itemi[ 'id_usrEncargado']!=0 ) { $usuario2= Usuario::buscarPorId($itemi[ 'id_usrEncargado']); echo $usuario2->getCorreo(); } ?>
                                            </td>
                                            <td>
                                                <?php echo $itemi[ 'estadoDetalle'] ?>
                                            </td>

                                        </tr>

                                        <?php } endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </li>



                    </ul>
                </div>
                <button class="waves-effect waves-red btn-large waves-color-demo " onclick="mostrar()" id="textCambia" name="action">Generar ticket
                    <i class="mdi-alert-warning right"></i>
                </button>
                <br/>
                <br/>
                <form action="../Back-End/Presentador/TicketsCrearPresentador.php" method="post" id='oculto' style='display:none;'>
                    <div class="contenedorLogin">

                        <div class="row">
                            <div class="col s6">
                                <label>Deje en blanco de ser usted el creador</label>
                                <select class="browser-default" name="id_usrCreador" >
                                    <option value="" disabled selected>Usuario con el inconveniente</option>
                                    <?php foreach($usuariosUsuario as $items):?>
                                        <option value="<?php echo $items['id'];?>">
                                            <?php echo $items[ 'correo'] ?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s4">
                                <label>Prioridad</label>
                                <select class="browser-default" name="prioridad" required>
                                    <option value="" disabled selected>Escoga la prioridad</option>
                                    <option value="BAJA">BAJA</option>
                                    <option value="MODERADA">MODERADA</option>
                                    <option value="ALTA">ALTA</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s4">
                                <label>Sistema Operativo</label>
                                <select class="browser-default" name="SO" required>
                                    <option value="" disabled selected>Escoga Sistema Operativo</option>
                                    <option value="Linux">Linux</option>
                                    <option value="Window">Window</option>
                                    <option value="iOS">iOS</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s5">
                                <label>Gerencia</label>
                                <select class="browser-default" name="gerencia" required>
                                    <option value="" disabled selected>Escoga la gerencia</option>
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

                <div style="color: white">
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
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>

</html>