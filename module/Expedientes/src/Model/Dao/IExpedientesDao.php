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

namespace Expedientes\Model\Dao;

use Expedientes\Model\Entity\Expedientes;

interface IExpedientesDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Expedientes $obj);
    
    public function eliminar(Expedientes $obj);
}
