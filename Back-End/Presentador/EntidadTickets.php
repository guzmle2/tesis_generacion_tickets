<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 14/05/2015
 * Time: 09:09 PM
 */
require_once 'EntidadConexion.php';
class Tickets{

    public $id;
    public $prioridad;
    public $SO;
    public $asunto;
    public $detalle;
    public $estado;
    public $id_encargado;
    public $id_creador;
    public $estadoDetalle;
    public $gerencia;
    const TABLA = 'tickets';



    public function __construct($p, $os, $a, $d,$e,$enc,$ed,$usrCr, $i,$g ){
        $this -> setPrioridad($p);
        $this -> setSO($os);
        $this -> setAsunto($a);
        $this -> setDetalle($d);
        $this -> setEstado($e);
        $this -> setIdEncargado($enc);
        $this -> setEstadoDetalle($ed);
        $this -> setIdCreador($usrCr);
        $this -> setGerencia($g);
        $this -> setId($i);
    }


    public function guardar(){
        $conexion = new Conexion();
        if($this->id) /*Modifica*/ {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            SO = :SO,
            asunto = :asunto,
            detalle = :detalle,
            estado = :estado,
            id_usrEncargado = :id_usrEncargado,
            estadoDetalle = :estadoDetalle,
            prioridad = :prioridad,
            id_usrCreador = :id_creador,
            gerencia = :gerencia
             WHERE id = :id');
            $consulta->bindParam(':SO', $this->getSO());
            $consulta->bindParam(':asunto', $this->getAsunto());
            $consulta->bindParam(':detalle', $this->getDetalle());
            $consulta->bindParam(':estado', $this->getEstado());
            $consulta->bindParam(':id_usrEncargado', $this->getIdEncargado());
            $consulta->bindParam(':estadoDetalle', $this->getEstadoDetalle());
            $consulta->bindParam(':prioridad', $this->getPrioridad());
            $consulta->bindParam(':id_creador', $this->getIdCreador());
            $consulta->bindParam(':gerencia', $this->getGerencia());
            $consulta->bindParam(':id', $this->getId());
            $consulta->execute();
        }else /*Inserta*/ {
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
             (SO,
            asunto,
            detalle,
            estado,
            id_usrEncargado,
            estadoDetalle,
            prioridad,
            id_usrCreador,
            gerencia)
             VALUES
             (:SO,
            :asunto,
            :detalle,
            :estado,
            :id_usrEncargado,
            :estadoDetalle,
            :prioridad,
            :id_usrCreador,
            :gerencia)');
            $consulta->bindParam(':SO', $this->getSO());
            $consulta->bindParam(':asunto', $this->getAsunto());
            $consulta->bindParam(':detalle', $this->getDetalle());
            $consulta->bindParam(':estado', $this->getEstado());
            $consulta->bindParam(':id_usrEncargado', $this->getIdEncargado());
            $consulta->bindParam(':estadoDetalle', $this->getEstadoDetalle());
            $consulta->bindParam(':prioridad', $this->getPrioridad());
            $consulta->bindParam(':id_usrCreador', $this->getIdCreador());
            $consulta->bindParam(':gerencia', $this->getGerencia());
            $consulta->execute();
            $this->id = $conexion->lastInsertId();
        }
        $conexion = null;
    }


    public static function buscarPorId($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT SO,
                                                asunto,
                                                detalle,
                                                estado,
                                                id_usrEncargado,
                                                estadoDetalle,
                                                prioridad,
                                                id_usrCreador,
                                                gerencia
                                                FROM ' . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self($registro['SO'],
                $registro['asunto'],
                $registro['detalle'],
                $registro['estado'],
                $registro['id_usrEncargado'],
                $registro['estadoDetalle'],
                $registro['prioridad'],
                $registro['id_usrCreador'],
                $id,
                $registro['gerencia']);
        }else{
            return false;
        }
    }

    public static function obtenerPorEstado($co){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' WHERE estado = :estado ORDER BY 1 ASC ');
        $consulta->bindParam(':estado', $co);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public static function obtenerPorIdCreador($idn){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT id,SO,
                                                asunto,
                                                detalle,
                                                estado,
                                                id_usrEncargado,
                                                estadoDetalle,
                                                prioridad,
                                                id_usrCreador,
                                                gerencia
                                                FROM ' . self::TABLA . ' WHERE id_usrCreador = :id_usrCreador');
        $consulta->bindParam(':id_usrCreador', $idn);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }


    public static function obtenerPorIdEncargado($idn){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT id,SO,
                                                asunto,
                                                detalle,
                                                estado,
                                                id_usrEncargado,
                                                estadoDetalle,
                                                prioridad,
                                                id_usrCreador,
                                                gerencia
                                                FROM ' . self::TABLA . ' WHERE id_usrEncargado = :id_usrEncargado');
        $consulta->bindParam(':id_usrEncargado', $idn);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }


    public static function obtenerPorUsuarioEstado($idUsuario, $estatus){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT SO,
                                                asunto,
                                                detalle,
                                                estado,
                                                id_usrEncargado,
                                                estadoDetalle,
                                                prioridad,
                                                id_usrCreador,
                                                gerencia
                                                FROM ' . self::TABLA . ' WHERE id_usrCreador = :idUsuario and estado = :estado ORDER BY 1 ASC ');
        $consulta->bindParam(':id_usrCreador', $idUsuario);
        $consulta->bindParam(':estado', $estatus);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public static function obtenerTodos(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT id,SO,
                                                asunto,
                                                detalle,
                                                estado,
                                                id_usrEncargado,
                                                estadoDetalle,
                                                prioridad,
                                                id_usrCreador,
                                                gerencia
                                                FROM ' . self::TABLA );
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    public static function obtenerTodosDesc(){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM ' . self::TABLA . ' order by 1 desc' );
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }


    /**
     * @return mixed
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * @param mixed $prioridad
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;
    }

    /**
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed $asunto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getEstadoDetalle()
    {
        return $this->estadoDetalle;
    }

    /**
     * @param mixed $estadoDetalle
     */
    public function setEstadoDetalle($estadoDetalle)
    {
        $this->estadoDetalle = $estadoDetalle;
    }

    /**
     * @return mixed
     */
    public function getSO()
    {
        return $this->SO;
    }

    /**
     * @param mixed $SO
     */
    public function setSO($SO)
    {
        $this->SO = $SO;
    }

    /**
     * @return mixed
     */
    public function getIdCreador()
    {
        return $this->id_creador;
    }

    /**
     * @param mixed $id_creador
     */
    public function setIdCreador($id_creador)
    {
        $this->id_creador = $id_creador;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdEncargado()
    {
        return $this->id_encargado;
    }

    /**
     * @param mixed $id_encargado
     */
    public function setIdEncargado($id_encargado)
    {
        $this->id_encargado = $id_encargado;
    }

    /**
     * @return mixed
     */
    public function getGerencia()
    {
        return $this->gerencia;
    }

    /**
     * @param mixed $gerencia
     */
    public function setGerencia($gerencia)
    {
        $this->gerencia = $gerencia;
    }

}