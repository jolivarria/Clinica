<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pacientes\Model\Entity;

/**
 * Description of Empleado
 *
 * @author jorge
 */
class Ingreso {

    private $idDepartamento; //int(11) PK 
    private $idConfiguracion;   // int(11) PK 
    private $nombre; //varchar(45) 
    private $descripcion; //text

    function getIdDepartamento() {
        return $this->idDepartamento;
    }

    function getIdConfiguracion() {
        return $this->idConfiguracion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }

    function setIdConfiguracion($idConfiguracion) {
        $this->idConfiguracion = $idConfiguracion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function exchangeArray($data) {
        $this->idDepartamento = (isset($data['idDepartamento'])) ? $data['idDepartamento'] : null;
        $this->idConfiguracion = (isset($data['idConfiguracion'])) ? $data['idConfiguracion'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
