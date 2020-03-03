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

use Pacientes\Model\Entity\Reporte;

interface IReporteDao {
    //put your code here
    public function obtenerTodos();

    public function obtnerID($id);
    
    public function guardar(Reporte $obj);
    
    public function eliminar(Reporte $obj);
}
