<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 19/05/2015
 * Time: 06:37 PM
 */

require_once 'EntidadUsuario.php';

$usuario = "usuario";
$admin = "admin";
$tecnico = "tecnico";

$personaje = Usuario::buscarPorCorreo( $_REQUEST['email']);

if($personaje){
    if($personaje->getClave() == $_REQUEST['password'] )
    {
        if($personaje->getTipo() == $usuario){
            header("location:../../vistas_usuario/index.php");
        }elseif($personaje->getTipo() == $admin){
            header("location:../../vistas_admin/index.php");
        }elseif($personaje->getTipo() == $tecnico){
            header("location:../../vistas_tecnico/index.php");
        }else{
            header("location:../../index.php?errorusuario=si");
        }
        session_start();
        $_SESSION['id_usuario'] = $personaje->getId();
    }else{
        header("location:../../index.php?errorusuario=si");
    }
}else{
    header("location:../../UsuarioAgregar.php?email=".$_REQUEST['email']);
}