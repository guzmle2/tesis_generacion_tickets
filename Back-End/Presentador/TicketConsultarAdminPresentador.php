<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 18/05/2015
 * Time: 10:51 PM
 */

include 'EntidadTickets.php';
include 'EntidadUsuario.php';
session_start();
$str = $_SESSION['id_usuario'];
$adminTickets = Tickets::obtenerTodos();
$adminTicketsDesc = Tickets::obtenerTodosDesc();

