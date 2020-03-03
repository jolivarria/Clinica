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
class Entradas{

    //PROPIEDADES DE LA TABLA INGRESOS//
    private $identradas; //int(11) AI PK 
    private $inventario_productos_idproductos; // int(11) PK 
    private $fecha; // date; //  
    private $cantidad; // int(11) 
    private $precio; // float; // text
    
    function getIdentradas() {
        return $this->identradas;
    }

    function getInventario_productos_idproductos() {
        return $this->inventario_productos_idproductos;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setIdentradas($identradas) {
        $this->identradas = $identradas;
    }

    function setInventario_productos_idproductos($inventario_productos_idproductos) {
        $this->inventario_productos_idproductos = $inventario_productos_idproductos;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }
    
    public function exchangeArray($data) {
        $this->identradas = (isset($data['identradas'])) ? $data['identradas'] : null;
        $this->inventario_productos_idproductos = (isset($data['inventario_productos_idproductos'])) ? $data['inventario_productos_idproductos'] : null;
        $this->fecha = (isset($data['fecha'])) ? $data['fecha'] : null;
        $this->cantidad = (isset($data['cantidad'])) ? $data['cantidad'] : null;
        $this->precio = (isset($data['precio'])) ? $data['precio'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
