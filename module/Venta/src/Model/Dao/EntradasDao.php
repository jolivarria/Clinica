<?php

namespace Inventario\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Inventario\Model\Entity\Entradas;
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
class EntradasDao implements IEntradasDao {

//put your code here
    protected $tableGateway;
    protected $dbAdapter;

    public function __construct(TableGateway $tableGateway,$adapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $adapter;
    }

    public function obtenerTodos() {

        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function obtenerView() {      
        $projectTable = new TableGateway('vm_entradas',$this->dbAdapter);
        $resultSet = $projectTable->select();
         return $resultSet;
       
    }

    public function obtnerID($id) {
        
    }

    public function guardar(Entradas $obj) {
        $data = [
            'identradas' => $obj->getIdentradas(),
            'productos_idproductos' => $obj->getProductos_idproductos(),            
            'cantidad' => $obj->getCantidad(),
            'precio' => $obj->getPrecio(),
        ];
        
        $id = (int) $obj->getIdentradas();
        if ($id == 0) {
            $this->tableGateway->insert($data);            
        } else {
            if ($this->obtnerID($id)) {
                $this->tableGateway->update($data, ['identradas' => $id]);
            } else {
                throw new RuntimeException("No se puede guardar: $id");
            }
        }
    }

    public function eliminar(Entradas $obj) {
        
    }

    public function ejectuarStoreProcedure() {
        
    }

}
