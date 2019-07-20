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

namespace Pacientes\Model\Dao;

use Pacientes\Model\Entity\Ingreso;

interface IIngresoDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Ingreso $obj);
    
    public function eliminar(Ingreso $obj);
}
