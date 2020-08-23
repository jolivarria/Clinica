<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Expedientes\Model\Entity;

/**
 * Description of Empleado
 *
 * @author jorge
 */
class Expedientes {

    private $idexpedientes;
    private $idpaciente; //int(11) AI PK
    private $nombre;
    private $tipo;
    private $acude;
    private $fecha;
    private $fechaIngreso;
    private $numeroExpediente;
    private $estado;
    private $nombreFam;
    private $celularFam;
    
    function getIdexpedientes() {
        return $this->idexpedientes;
    }

    function setIdexpedientes($idexpedientes) {
        $this->idexpedientes = $idexpedientes;
    }

        function getIdpaciente() {
        return $this->idpaciente;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getAcude() {
        return $this->acude;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getFechaIngreso() {
        return $this->fechaIngreso;
    }

    function getNumeroExpediente() {
        return $this->numeroExpediente;
    }

    function getEstado() {
        return $this->estado;
    }

    function getNombreFam() {
        return $this->nombreFam;
    }

    function getCelularFam() {
        return $this->celularFam;
    }

    function setIdpaciente($idpaciente) {
        $this->idpaciente = $idpaciente;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setAcude($acude) {
        $this->acude = $acude;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setFechaIngreso($fechaIngreso) {
        $this->fechaIngreso = $fechaIngreso;
    }

    function setNumeroExpediente($numeroExpediente) {
        $this->numeroExpediente = $numeroExpediente;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setNombreFam($nombreFam) {
        $this->nombreFam = $nombreFam;
    }

    function setCelularFam($celularFam) {
        $this->celularFam = $celularFam;
    }

    public function exchangeArray($data) {
        $this->idexpedientes = (isset($data['idexpedientes'])) ? $data['idexpedientes'] : null;
        $this->idpaciente = (isset($data['idpaciente'])) ? $data['idpaciente'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->tipo = (isset($data['tipo'])) ? $data['tipo'] : null;
        $this->acude = (isset($data['acude'])) ? $data['acude'] : null;
        $this->fecha = (isset($data['fecha'])) ? $data['fecha'] : null;
        $this->fechaIngreso = (isset($data['fechaIngreso'])) ? $data['fechaIngreso'] : null;
        $this->numeroExpediente = (isset($data['numeroExpediente'])) ? $data['numeroExpediente'] : null;
        $this->estado = (isset($data['estado'])) ? $data['estado'] : null;
        $this->nombreFam = (isset($data['nombreFam'])) ? $data['nombreFam'] : null;
        $this->celularFam = (isset($data['celularFam'])) ? $data['celularFam'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
