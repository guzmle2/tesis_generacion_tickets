<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 14/05/2015
 * Time: 09:09 PM
 */
require_once 'EntidadConexion.php';
class Usuario{

    private $id;
    private $nombre;
    private $apellido;
    private $cedula;
    private $celular;
    private $extension;
    private $gerencia;
    private $clave;
    private $tipo;
    private $correo;
    private $_instance;
    const TABLA = 'usuario';



    public function __construct($n, $a, $ced, $cel, $e, $g,$cl,$t,$col, $idn) {
        $this->setId($idn);
        $this->setNombre($n);
        $this->setApellido($a);
        $this->setCedula($ced);
        $this->setCelular($cel);
        $this->setExtension($e);
        $this->setGerencia($g);
        $this->setClave($cl);
        $this->setTipo($t);
        $this->setCorreo($col);
    }

    /**
     * metodo que guarda el vistas_usuario o lo actualiza segun sea el caso
     */
    public function guardar(){
        $conexion = new Conexion();
        if($this->id) /*Modifica*/ {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA .' SET
            nombre = :nombre,
            apellido = :apellido,
            cedula = :cedula,
            celular = :celular,
            extension = :extension,
            gerencia = :gerencia,
            clave = :clave,
            correo = :correo,
            tipo = :tipo
             WHERE id = :id');
            $consulta->bindParam(':nombre', $this->getNombre());
            $consulta->bindParam(':apellido', $this->getApellido());
            $consulta->bindParam(':cedula', $this->getCedula());
            $consulta->bindParam(':celular', $this->getCelular());
            $consulta->bindParam(':extension', $this->getExtension());
            $consulta->bindParam(':gerencia', $this->getGerencia());
            $consulta->bindParam(':clave', $this->getClave());
            $consulta->bindParam(':correo', $this->getCorreo());
            $consulta->bindParam(':tipo', $this->getTipo());
            $consulta->bindParam(':id', $this->id);
            $consulta->execute();
        }else /*Inserta*/ {
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA .'
             (nombre,
             apellido,
             cedula,
             celular,
             extension,
             gerencia,
             clave,
             correo,
             tipo)
             VALUES
             (:nombre,
              :apellido,
              :cedula,
              :celular,
              :extension,
              :gerencia,
              :clave,
              :correo,
              :tipo)');
            $consulta->bindParam(':nombre', $this->getNombre());
            $consulta->bindParam(':apellido', $this->getApellido());
            $consulta->bindParam(':cedula', $this->getCedula());
            $consulta->bindParam(':celular', $this->getCelular());
            $consulta->bindParam(':extension', $this->getExtension());
            $consulta->bindParam(':gerencia', $this->getGerencia());
            $consulta->bindParam(':clave', $this->getClave());
            $consulta->bindParam(':tipo', $this->getTipo());
            $consulta->bindParam(':correo', $this->getCorreo());
            $consulta->execute();
            $this->id = $conexion->lastInsertId();
        }
        $conexion = null;
    }

    /**
     * metodo para ubicar por id
     * @param $id parametro de busqueda
     * @return bool|Usuario si agrego
     */
    public static function buscarPorId($id){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT nombre,
                                                apellido,
                                                cedula,
                                                celular,
                                                extension,
                                                gerencia,
                                                clave,
                                                tipo,
                                                correo
                                                FROM ' . self::TABLA . ' WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self($registro['nombre'],
                $registro['apellido'],
                $registro['cedula'],
                $registro['celular'],
                $registro['extension'],
                $registro['gerencia'],
                $registro['clave'],
                $registro['tipo'],
                $registro['correo'],
                $id);
        }else{
            return false;
        }
    }


    /**
     * @param $co
     * @return bool|Usuario
     */
    public static function buscarPorCorreo($co){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT id,
                                                nombre,
                                                apellido,
                                                cedula,
                                                celular,
                                                extension,
                                                gerencia,
                                                clave,
                                                tipo
                                                FROM ' . self::TABLA . ' WHERE correo = :email');
        $consulta->bindParam(':email', $co);
        $consulta->execute();
        $registro = $consulta->fetch();
        if($registro){
            return new self(
                $registro['nombre'],
                $registro['apellido'],
                $registro['cedula'],
                $registro['celular'],
                $registro['extension'],
                $registro['gerencia'],
                $registro['clave'],
                $registro['tipo'],
                $co,
                $registro['id']);
        }else{
            return false;
        }
    }


    public static function buscarPorTipoUsuario($tip){
        $conexion = new Conexion();
        $consulta = $conexion->prepare(('SELECT id,
                                                nombre,
                                                apellido,
                                                cedula,
                                                celular,
                                                extension,
                                                gerencia,
                                                clave,
                                                tipo,
                                                correo
                                                FROM ' . self::TABLA . ' WHERE tipo = :tipo'));
        $consulta->bindParam(':tipo', $tip);
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
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

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return mixed
     */
    public function getObjTicket()
    {
        return $this->objTicket;
    }

    /**
     * @param mixed $objTicket
     */
    public function setObjTicket($objTicket)
    {
        $this->objTicket = $objTicket;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
    * @return mixed
    */public function getClave()
    {
        return $this->clave;
    }

    /**
    * @param mixed $clave
    */public function setClave($clave)
    {
        $this->clave = $clave;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getIden()
    {
        return $this->iden;
    }

    /**
     * @param mixed $iden
     */
    public function setIden($iden)
    {
        $this->iden = $iden;
    }


}