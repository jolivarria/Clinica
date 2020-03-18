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
class Entradas {

    //PROPIEDADES DE LA TABLA INGRESOS//
    private $identradas; //int(11) AI PK 
    private $productos_idproductos; // int(11) PK 
    private $nombre; //varchar(45)
    private $fecha; // date; //
    private $cantidadMinima; // int(11)
    private $cantidad; // int(11) 
    private $precio; // float; // text

    function getIdentradas() {
        return $this->identradas;
    }

    function getProductos_idproductos() {
        return $this->productos_idproductos;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFecha() {
        return $this->fecha;
    }
    function getCantidadMinima() {
        return $this->cantidadMinima;
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

    function setProductos_idproductos($productos_idproductos) {
        $this->productos_idproductos = $productos_idproductos;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setCantidadMinima($cantidadMinima) {
        $this->cantidadMinima = $cantidadMinima;
    }
    
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function exchangeArray($data) {
        $this->identradas = (isset($data['identradas'])) ? $data['identradas'] : null;
        $this->productos_idproductos = (isset($data['productos_idproductos'])) ? $data['productos_idproductos'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->fecha = (isset($data['fecha'])) ? $data['fecha'] : null;
        $this->cantidad = (isset($data['cantidad'])) ? $data['cantidad'] : null;
        $this->cantidadMinima = (isset($data['cantidadMinima'])) ? $data['cantidadMinima'] : null;
        $this->precio = (isset($data['precio'])) ? $data['precio'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
