<?php

namespace Pacientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Pacientes\Model\Entity\SolicitudIngreso;
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

class SolicitudIngresoDao implements ISolicitudIngresoDao {

//put your code here
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtnerID($id) {
        $rowSet = $this->tableGateway->select(['idSolicitud' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $id");
        return $row;
    }

    public function obtenerDetalle($RFC) {
        $rowSet = $this->tableGateway->select(["rfc" => (string) $RFC]);               
        return $rowSet;
    }
    public function obtenerDetalleConunt($RFC) {
       $rowSet = $this->tableGateway->select(["rfc" => (string) $RFC]);
        $row = $rowSet->count();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $RFC");
        return $row;
    }
    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    
    public function buscarRFC($RFC){
        $rowSet = $this->tableGateway->select(['rfc' => (string) $RFC]);
        $row = $rowSet->current();
//        if (!$row)
//            throw new RuntimeException("No se puede tener acceso a : $RFC");
        return $row;
    }

    public function guardar(SolicitudIngreso $obj) {
        $data = [
            'rfc'               => $obj->getRfc(),
            'nombrePaciente'    => $obj->getNombrePaciente(),
            'sexo'              => $obj->getSexo(),
            'edad'              => $obj->getEdad(),
            'tipoSolicitud'     => $obj->getTipoSolicitud(),
            'domicilio'         => $obj->getDomicilio(),
            'colonia'           => $obj->getColonia(),
            'municipio'         => $obj->getMunicipio(),           
            'nombreFamiliar'    => $obj->getNombreFamiliar(),
            'parentesco'        => $obj->getParentesco(),
            'telefono'          => $obj->getTelefono(),
            'costo'             => $obj->getCosto(),
        ];

        $id = (int) $obj->getIdSolicitud();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if($this->obtnerID($id)){
                $this->tableGateway->update($data,['idSolicitud' => $id]);
            }else{
                throw new RuntimeException("No se puede guardar: $id");
            }
       
        }
    }
    
    public function eliminar(SolicitudIngreso $obj) {
        $this->tableGateway->delete(['idSolicitud' => $obj->getIdSolicitud()]);
    }
    
    

}
