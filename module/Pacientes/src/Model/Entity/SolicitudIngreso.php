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
class SolicitudIngreso {

    private $idSolicitud; //int(11) AI PK 
    private $RFC; //varchar(45)
    private $nombrePaciente; // varchar(45) 
    private $sexo; //enum('Hombre','Mujer') 
    private $edad; //int(11) 
    private $tipoSolicitud; //enum('Foranea','Local
    private $domicilio; //varchar(45) 
    private $colonia; //varchar(45)
    private $municipio; //varchar(45)        
    private $nombreFamiliar; //varchar(45) 
    private $parentesco; //varchar(45) 
    private $telefono; //varchar(45) 
    private $costo; //float
    private $estado; //tinyint(2) 
    private $fechaSolicitud; //datetime

    public function getIdSolicitud() {
        return $this->idSolicitud;
    }
    public function getRFC() {
        return $this->RFC;
    }

    public function getNombrePaciente() {
        return $this->nombrePaciente;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getTipoSolicitud() {
        return $this->tipoSolicitud;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getColonia() {
        return $this->colonia;
    }

    public function getMunicipio() {
        return $this->municipio;
    }

    public function getNombreFamiliar() {
        return $this->nombreFamiliar;
    }

    public function getParentesco() {
        return $this->parentesco;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

    public function setIdSolicitud($idSolicitud) {
        $this->idSolicitud = $idSolicitud;
    }
    public function setRFC($RFC) {
        $this->idSolicitud = $RFC;
    }

    public function setNombrePaciente($nombrePaciente) {
        $this->nombrePaciente = $nombrePaciente;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setTipoSolicitud($tipoSolicitud) {
        $this->tipoSolicitud = $tipoSolicitud;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    public function setColonia($colonia) {
        $this->colonia = $colonia;
    }

    public function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    public function setNombreFamiliar($nombreFamiliar) {
        $this->nombreFamiliar = $nombreFamiliar;
    }

    public function setParentesco($parentesco) {
        $this->parentesco = $parentesco;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setFechaSolicitud($fechaSolicitud) {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    public function exchangeArray($data) {
        $this->idSolicitud = (isset($data['idSolicitud'])) ? $data['idSolicitud'] : null;
        $this->RFC = (isset($data['RFC'])) ? $data['RFC'] : null;
        $this->nombrePaciente = (isset($data['nombrePaciente'])) ? $data['nombrePaciente'] : null;
        $this->sexo = (isset($data['sexo'])) ? $data['sexo'] : null;
        $this->edad = (isset($data['edad'])) ? $data['edad'] : null;
        $this->domicilio = (isset($data['domicilio'])) ? $data['domicilio'] : null;
        $this->colonia = (isset($data['colonia'])) ? $data['colonia'] : null;
        $this->tipoSolicitud = (isset($data['tipoSolicitud'])) ? $data['tipoSolicitud'] : null;
        $this->municipio = (isset($data['municipio'])) ? $data['municipio'] : null;
        $this->nombreFamiliar = (isset($data['nombreFamiliar'])) ? $data['nombreFamiliar'] : null;
        $this->parentesco = (isset($data['parentesco'])) ? $data['parentesco'] : null;
        $this->telefono = (isset($data['telefono'])) ? $data['telefono'] : null;
        $this->costo = (isset($data['costo'])) ? $data['costo'] : null;
        $this->estado = (isset($data['estado'])) ? $data['estado'] : null;
        $this->fechaSolicitud = (isset($data['fechaSolicitud'])) ? $data['fechaSolicitud'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
