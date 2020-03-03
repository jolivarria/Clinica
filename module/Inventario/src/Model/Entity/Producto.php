<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Inventario\Model\Entity;

/**
 * Description of Empleado
 *
 * @author jorge
 */
class Producto{

    //PROPIEDADES DE LA TABLA INGRESOS//
    private $idproductos; //int(11) AI PK 
    private $codigo; // varchar(45)
    private $nombre; // varchar(45) 
    private $unidadMedida; // enum('Kilo','Pieza','Paquete','Bolsa') 
    private $precio; // float 
    private $descripcion; // text

    function getIdproductos() {
        return $this->idproductos;
    }

    function getCodigo(){
        return $this->codigo;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getUnidadMedida() {
        return $this->unidadMedida;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdproductos($idproductos) {
        $this->idproductos = $idproductos;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setUnidadMedida($unidadMedida) {
        $this->unidadMedida = $unidadMedida;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    
    
    
    public function exchangeArray($data) {
        $this->idproductos = (isset($data['idproductos'])) ? $data['idproductos'] : null;
        $this->codigo = (isset($data['codigo'])) ? $data['codigo'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->unidadMedida = (isset($data['unidadMedida'])) ? $data['unidadMedida'] : null;
        $this->precio = (isset($data['precio'])) ? $data['precio'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
