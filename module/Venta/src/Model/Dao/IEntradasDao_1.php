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

use Inventario\Model\Entity\Entradas;

interface IEntradasDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Entradas $obj);
    
    public function eliminar(Entradas $obj);
   
}
