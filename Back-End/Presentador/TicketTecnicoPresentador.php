<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 15/05/2015
 * Time: 10:44 PM
 */
require_once 'EntidadTickets.php';
session_start();
$str = $_SESSION['id_usuario'];
$tike_old = Tickets::buscarPorId($_POST['id_tickets']);
$tick = new Tickets(
    $tike_old->getPrioridad(),
    $tike_old->getSO(),
    $tike_old->getAsunto(),
    $tike_old->getDetalle(),
    $_POST['estatus'],
    $str,
    $_POST['detalleEstado'],
    $tike_old->getIdCreador(),
    $_POST['id_tickets'],
    $tike_old->getGerencia());
$tick->guardar();
header("location:../../vistas_tecnico/");