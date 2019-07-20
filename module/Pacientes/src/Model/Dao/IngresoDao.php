<?php

namespace Pacientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Pacientes\Model\Entity\Ingreso;
use RuntimeException;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpleadoDao
 *
 * @author jorge
 */
class IngresoDao implements IIngresoDao {

//put your code here
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerTodos() {
//        $resultSet = $this->tableGateway->select();
//        return $resultSet;
        $resultSet = $this->adapter->query("SELECT * FROM vm_ingresos");
        return $resultSet->execute();
    }


    public function obtnerID($id){
        
    }
    
    public function guardar(Ingreso $obj){
        
    }
    
    public function eliminar(Ingreso $obj);

 

}
