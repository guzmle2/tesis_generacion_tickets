<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 15/05/2015
 * Time: 10:44 PM
 */
require_once 'EntidadUsuario.php';
session_start();
$str = $_SESSION['id_usuario'];
$usuario = new Usuario(
    $_POST['nombre'],
    $_POST['apellido'],
    $_POST['cedula'],
    $_POST['celular'],
    $_POST['extension'],
    $_POST['gerencia'],
    $_POST['clave'],
    $_POST['tipo'],
    $_POST['correo'],
    $str);
$usuario->guardar();
header("location:../../vistas_usuario/index.php?modificado=si");