<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 18/05/2015
 * Time: 10:51 PM
 */

include 'EntidadTickets.php';
session_start();
$str = $_SESSION['id_usuario'];$personajes = Tickets::obtenerPorIdCreador($str);
