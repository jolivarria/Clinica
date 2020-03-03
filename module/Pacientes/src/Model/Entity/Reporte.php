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
class Reporte {

    private $idReporte911; // int(11) AI PK 
    private $solicitudIngreso_idSolicitud; //  int(11) PK 
    private $vehiculos_idvehiculos; //  int(11) PK 
    private $operadora; // varchar(45) 
    private $folio; // varchar(45) 
    private $observaciones; // varchar(45)
    private $fechaReporte; // timestamp

    public function getIdReporte911() {
        return $this->idReporte911;
    }

    public function getSolicitudIngreso_idSolicitud() {
        return $this->solicitudIngreso_idSolicitud;
    }

    public function getVehiculos_idvehiculos() {
        return $this->vehiculos_idvehiculos;
    }

    public function getOperadora() {
        return $this->operadora;
    }

    public function getFolio() {
        return $this->folio;
    }

    public function getObservacion() {
        return $this->observaciones;
    }

    public function getFechaReporte() {
        return $this->fechaReporte;
    }
    //SETER    
    public function setIdReporte911($idReporte911) {
        $this->idReporte911 = $idReporte911;
    }

    function setSolicitudIngreso_idSolicitud($solicitudIngreso_idSolicitud) {
        $this->solicitudIngreso_idSolicitud = $solicitudIngreso_idSolicitud;
    }

    function setVehiculos_idvehiculos($vehiculos_idvehiculos) {
        $this->vehiculos_idvehiculos = $vehiculos_idvehiculos;
    }

    function setOperadora($operadora) {
        $this->operadora = $operadora;
    }

    function setFolio($folio) {
        $this->folio = $folio;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setFechaReporte($fechaReporte) {
        $this->fechaReporte = $fechaReporte;
    }

    public function exchangeArray($data) {
        $this->idReporte911 = (isset($data['idReporte911'])) ? $data['idReporte911'] : null;
        $this->solicitudIngreso_idSolicitud = (isset($data['solicitudIngreso_idSolicitud'])) ? $data['solicitudIngreso_idSolicitud'] : null;
        $this->vehiculos_idvehiculos = (isset($data['vehiculos_idvehiculos'])) ? $data['vehiculos_idvehiculos'] : null;
        $this->operadora = (isset($data['operadora'])) ? $data['operadora'] : null;
        $this->folio = (isset($data['folio'])) ? $data['folio'] : null;
        $this->observaciones = (isset($data['observaciones'])) ? $data['observaciones'] : null;
        $this->fechaReporte = (isset($data['fechaReporte'])) ? $data['fechaReporte'] : null;       
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
