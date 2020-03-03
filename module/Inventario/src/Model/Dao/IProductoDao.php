<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IEmpleadoDao
 *
 * @author jorge
 */

namespace Inventario\Model\Dao;

use Inventario\Model\Entity\Producto;

interface IProductoDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Producto $obj);
    
    public function eliminar(Producto $obj);
   
}
