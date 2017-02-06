<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 15/05/2015
 * Time: 10:44 PM
 */
require_once 'EntidadTickets.php';
$tike_old = Tickets::buscarPorId($_POST['id_tickets']);

if(isset($_POST['estado']))
{
    $estado =$_POST['estado'];

}else{
    $estado = 'ABIERTO';

}


if(isset($_POST['id_usrEncargado']))
{
    $encargado =$_POST['id_usrEncargado'];

}else{
    $encargado = $tike_old->getIdCreador();

}

$tick = new Tickets(
    $tike_old->getPrioridad(),
    $tike_old->getSO(),
    $tike_old->getAsunto(),
    $tike_old->getDetalle(),
    $estado,
    $encargado,
    '',
    $tike_old->getIdCreador(),
    $_POST['id_tickets'],
    $tike_old->getGerencia());

$tick->guardar();
header("location:../../vistas_admin/index.php?");