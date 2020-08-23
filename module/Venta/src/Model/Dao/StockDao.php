<?php

namespace Inventario\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Inventario\Model\Entity\Stock;
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
class StockDao implements IStockDao {

//put your code here
    protected $tableGateway;
    protected $dbAdapter;
            
    public function __construct(TableGateway $tableGateway,$dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
    }
    public function obtenerView() {      
        $projectTable = new TableGateway('vm_inventario',$this->dbAdapter);
        $resultSet = $projectTable->select();       
         return $resultSet;
    }
}
