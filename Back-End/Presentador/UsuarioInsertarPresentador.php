<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 15/05/2015
 * Time: 10:44 PM
 */
  require_once 'EntidadUsuario.php';
$str = $_REQUEST['correo'];
$usuario = "usuario";
$admin = "admin";
$tecnico = "tecnico";

if (strpos($str, $tecnico)) {
    $tusuario = 'tecnico';
}elseif(strpos($str, $admin)){
    $tusuario = 'admin';
}else{
    $tusuario = 'usuario';
}
    $usuario = new Usuario(
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['cedula'],
        $_POST['celular'],
        $_POST['extension'],
        $_POST['gerencia'],
        $_POST['clave'],
        $tusuario,
        $_POST['correo'], null);
    $usuario->guardar();
    header("location:../../index.php?usuarionuevo=si");
