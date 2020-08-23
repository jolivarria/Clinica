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
class Salidas{

    //PROPIEDADES DE LA TABLA INGRESOS//
    private $idsalidas; //int(11) AI PK 
    private $productos_idproductos; // int(11) PK 
    private $cantidad; // int(11) 
    private $precio; // float 
    private $concepto; // text 
    private $fechaSalida; // timestamp
    
    function getIdentradas() {
        return $this->idsalidas;
    }

    function getProductos_idproductos() {
        return $this->productos_idproductos;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getConcepto() {
        return $this->concepto;
    }

    function getFechaSalida() {
        return $this->fechaSalida;
    }

    function setIsalidas($idsalidas) {
        $this->idsalidas = $idsalidas;
    }

    function setProductos_idproductos($productos_idproductos) {
        $this->productos_idproductos = $productos_idproductos;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

    function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;
    }

        
   
    
    public function exchangeArray($data) {
        $this->idsalidas = (isset($data['idsalidas'])) ? $data['idsalidas'] : null;
        $this->productos_idproductos = (isset($data['productos_idproductos'])) ? $data['productos_idproductos'] : null;
        $this->cantidad = (isset($data['cantidad'])) ? $data['cantidad'] : null;
        $this->precio = (isset($data['precio'])) ? $data['precio'] : null;
        $this->concepto = (isset($data['concepto'])) ? $data['concepto'] : null;
        $this->fechaSalida = (isset($data['fechaSalida'])) ? $data['fechaSalida'] : null;
        
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
