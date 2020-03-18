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

use Inventario\Model\Entity\Salidas;

interface ISalidasDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Salidas $obj);
    
    public function eliminar(Salidas $obj);
   
}
