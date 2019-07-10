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

namespace Empleados\Model\Dao;

use Empleados\Model\Entity\Empleado;

interface IEmpleadoDao {
    //put your code here
    public function obtenerEmpleado();

    public function obtnerEmpleadoID($id);
    
    public function guardar(Empleado $emplado);
    
    public function eliminar(Empleado $emplado);
}
