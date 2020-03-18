<?php

namespace Pacientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
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
    protected $dbAdapter;

    public function __construct(TableGateway $tableGateway,$dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
    }

    public function obtenerTodos() {
         $resultSet = $this->tableGateway->select();
        return $resultSet;

    }
    
    public function obtenerView() {      
        $projectTable = new TableGateway('vm_ingresos',$this->dbAdapter);
        $resultSet = $projectTable->select();        
         return $resultSet;
       
    }

    public function guardarIngresos(Ingreso $obj) {        
        $sql = "CALL sp_ingresos('{$obj->getRfc()}','{$obj->getFoto()}','{$obj->getNombre()}','{$obj->getSexo()}','{$obj->getFechaNac()}','{$obj->getEdad()}','{$obj->getDireccion()}','{$obj->getEscolaridad()}','{$obj->getOcupacion()}','{$obj->getEstadoCivil()}','{$obj->getCodigoPostal()}','{$obj->getTelefonoParticular()}','{$obj->getCelular()}','{$obj->getTelefonoTrabajo()}','{$obj->getServicioMedico()}','{$obj->getServicioMedico()}','{$obj->getNumero()}','Usuario','{$obj->getEmail()}')";
        var_dump($sql);
        $statement = $this->tableGateway->getAdapter()->createStatement($sql);
        $statement->execute();
        $resultado = $statement->current();
        return $resultado['resultado'];
//        $query = $this->tableGateway->getAdapter()->query("select @res as resultado");
//        $fila = $query->execute();
//        
        
    }

    public function obtnerID($id) {
        
    }

    public function guardar(Ingreso $obj) {
        
    }

    public function eliminar(Ingreso $obj) {
        
    }

}
