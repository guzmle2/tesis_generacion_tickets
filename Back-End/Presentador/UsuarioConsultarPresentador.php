<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 18/05/2015
 * Time: 09:52 PM
 */
require_once 'EntidadUsuario.php';
session_start();
$str = $_SESSION['id_usuario'];
$usuario = Usuario::buscarPorId($str);