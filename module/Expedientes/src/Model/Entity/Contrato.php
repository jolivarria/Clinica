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
class Contrato {

    private $idcontrato; // int(11) PK 
    private $idexpedientes; // int(11) PK 
    private $idpaciente; // int(11) PK
    private $tiempo; //enum('3 Meses','6 Meses','12 Meses')
    private $costoTratamiento; // float 
    private $pagoIngreso; // float 
    private $plazo; // enum('Semanal','Quincenal','Mensual')
    private $cantidadPago; //pago float
    private $fechaContrato; // timestamp;
    
    
    function getTiempo() {
        return $this->tiempo;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

        function getPagoIngreso() {
        return $this->pagoIngreso;
    }

    function setPagoIngreso($pagoIngreso) {
        $this->pagoIngreso = $pagoIngreso;
    }

        
    
    function getCantidadPago() {
        return $this->cantidadPago;
    }

    function setCantidadPago($cantidadPago) {
        $this->cantidadPago = $cantidadPago;
    }

            function getIdcontrato() {
        return $this->idcontrato;
    }

    function getIdexpedientes() {
        return $this->idexpedientes;
    }

    function getIdpaciente() {
        return $this->idpaciente;
    }

    function getCostoTratamiento() {
        return $this->costoTratamiento;
    }

    function getPlazo() {
        return $this->plazo;
    }

    function getFechaContrato() {
        return $this->fechaContrato;
    }

    function setIdcontrato($idcontrato) {
        $this->idcontrato = $idcontrato;
    }

    function setIdexpedientes($idexpedientes) {
        $this->idexpedientes = $idexpedientes;
    }

    function setIdpaciente($idpaciente) {
        $this->idpaciente = $idpaciente;
    }

    function setCostoTratamiento($costoTratamiento) {
        $this->costoTratamiento = $costoTratamiento;
    }

    function setPlazo($plazo) {
        $this->plazo = $plazo;
    }

    function setFechaContrato($fechaContrato) {
        $this->fechaContrato = $fechaContrato;
    }

    
        
    public function exchangeArray($data) {
        $this->idcontrato = (isset($data['idcontrato'])) ? $data['idcontrato'] : null;
        $this->idexpedientes = (isset($data['idexpedientes'])) ? $data['idexpedientes'] : null;
        $this->idpaciente = (isset($data['idpaciente'])) ? $data['idpaciente'] : null;
        $this->tiempo = (isset($data['tiempo'])) ? $data['tiempo'] : null;
        $this->costoTratamiento = (isset($data['costoTratamiento'])) ? $data['costoTratamiento'] : null;
        $this->pagoIngreso = (isset($data['pagoIngreso'])) ? $data['pagoIngreso'] : null;        
        $this->plazo = (isset($data['plazo'])) ? $data['plazo'] : null;
        $this->cantidadPago = (isset($data['cantidadPago'])) ? $data['cantidadPago'] : null;
        $this->fechaContrato = (isset($data['fechaContrato'])) ? $data['fechaContrato'] : null;
       
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
