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
class Vehiculo {

    private $idvehiculos;// int(11) AI PK 
    private $marca;// varchar(45) 
    private $modelo;// varchar(45) 
    private $placas;// varchar(45) 
    private $descripcion;// text; // timestamp

    function getIdvehiculos() {
        return $this->idvehiculos;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getPlacas() {
        return $this->placas;
    }

        function getDescripcion() {
        return $this->descripcion;
    }

    function setIdvehiculos($idvehiculos) {
        $this->idvehiculos = $idvehiculos;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setPlacas($placas) {
        $this->placas = $placas;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function exchangeArray($data) {
        $this->idvehiculos = (isset($data['idvehiculos'])) ? $data['idvehiculos'] : null;
        $this->marca = (isset($data['marca'])) ? $data['marca'] : null;
        $this->modelo = (isset($data['modelo'])) ? $data['modelo'] : null;
        $this->placas = (isset($data['placas'])) ? $data['placas'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
       
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
