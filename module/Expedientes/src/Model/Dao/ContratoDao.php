<?php

namespace Expedientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Expedientes\Model\Entity\Contrato;
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
class ContratoDao implements IContratoDao {

//put your code here
    protected $tableGateway;
    protected $dbAdapter;

    public function __construct(TableGateway $tableGateway, $dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
    }

    public function obtenerView() {
        $projectTable = new TableGateway('vm_contrato', $this->dbAdapter);
        $resultSet = $projectTable->select();
        return $resultSet;
    }

    public function buscarContrato($idexpedientes){
         $sql = "CALL sp_buscar_contrato({$idexpedientes})";
         $result = $this->tableGateway->getAdapter()->createStatement($sql);
         $result->execute();
         $statement = $result->getResource();
         $resultSet1 = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return $resultSet1;
    }
       
    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function obtnerID($id) {
        $rowSet = $this->tableGateway->select(['idcontrato' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $id");
        return $row;
    }

    public function guardar(Contrato $obj) {
        $data = [
            'idexpedientes' => $obj->getIdexpedientes(),
            'idpaciente' => $obj->getIdpaciente(),
            'tiempo'    => $obj->getTiempo(),
            'costoTratamiento' => $obj->getCostoTratamiento(),
            'pagoIngreso'     => $obj->getPagoIngreso(),
            'plazo' => $obj->getPlazo(),
            'cantidadPago' => $obj->getCantidadPago(),
        ];

        $id = (int) $obj->getIdcontrato();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtnerID($id)) {
                $this->tableGateway->update($data, ['idcontrato' => $id]);
            } else {
                throw new RuntimeException("No se puede guardar: $id");
            }
        }
    }

    public function eliminar(Contrato $obj) {
        
    }

}
