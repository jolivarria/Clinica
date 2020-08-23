<?php

namespace Expedientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Expedientes\Model\Entity\Expedientes;
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
class ExpedientesDao implements IExpedientesDao {

//put your code here
    protected $tableGateway;
    protected $dbAdapter;

    public function __construct(TableGateway $tableGateway, $dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
    }

    public function obtenerView() {
        $projectTable = new TableGateway('vm_expedientes', $this->dbAdapter);
        $resultSet = $projectTable->select();
        return $resultSet;
    }
    
    public function obtenerTodos(){
    
    }

    public function obtenerExpediente($idpaciente){
         $sql = "CALL sp_expediente({$idpaciente})";
         $result = $this->tableGateway->getAdapter()->createStatement($sql);
         $result->execute();
         $statement = $result->getResource();
         $resultSet1 = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return $resultSet1;
    }
    
    public function obtnerID($id) {
        
    }

    public function guardar(Expedientes $obj) {
        
    }

    public function eliminar(Expedientes $obj) {
        
    }

}
