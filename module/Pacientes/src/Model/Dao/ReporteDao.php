<?php

namespace Pacientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Pacientes\Model\Entity\Reporte;
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

class ReporteDao implements IReporteDao {

//put your code here
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtnerID($id) {
        $rowSet = $this->tableGateway->select(['idReporte911' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $id");
        return $row;
    }
    
     public function obtnerIdSolicitud($id) {
        $rowSet = $this->tableGateway->select(['solicitudIngreso_idSolicitud' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $id");
        return $row;
    }
//    public function obtenerDetalle($RFC) {
//        $rowSet = $this->tableGateway->select(["RFC" => (string) $RFC]);               
//        return $rowSet;
//    }
//    public function obtenerDetalleConunt($RFC) {
//       $rowSet = $this->tableGateway->select(["RFC" => (string) $RFC]);
//        $row = $rowSet->count();
//        if (!$row)
//            throw new RuntimeException("No se puede tener acceso a : $RFC");
//        return $row;
//    }
    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    

    public function guardar(Reporte $obj) {
        $data = [
            'idReporte911'                      => $obj->getIdReporte911(),
            'solicitudIngreso_idSolicitud'      => $obj->getSolicitudIngreso_idSolicitud(),
            'vehiculos_idvehiculos'             => $obj->getVehiculos_idvehiculos(),
            'operadora'                         => $obj->getOperadora(),
            'folio'                             => $obj->getFolio(),
            'observaciones'                     => $obj->getObservacion(),
            'fechaReporte'                      => $obj->getFechaReporte(),
           
        ];
      
        $id = (int) $obj->getIdReporte911();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if($this->obtnerID($id)){
                $this->tableGateway->update($data,['idReporte911' => $id]);
            }else{
                throw new RuntimeException("No se puede guardar: $id");
            }
       
        }
    }
    
    public function eliminar(Reporte $obj) {
        $this->tableGateway->delete(['idReporte911' => $obj->getIdReporte911()]);
    }
    
    

}
