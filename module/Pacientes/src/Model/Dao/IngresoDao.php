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

    public function __construct(TableGateway $tableGateway, $dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
    }

    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function obtenerView() {
        $projectTable = new TableGateway('vm_ingresos', $this->dbAdapter);
        $resultSet = $projectTable->select();
        return $resultSet;
    }

    public function guardarIngresos(Ingreso $obj) {
        $sql = "CALL sp_ingreso('{$obj->getRfc()}','{$obj->getFoto()}','{$obj->getNombre()}','{$obj->getSexo()}','{$obj->getFechaNac()}','{$obj->getEdad()}','{$obj->getEscolaridad()}','{$obj->getOcupacion()}','{$obj->getEstadoCivil()}','{$obj->getTelefonoPp()}','{$obj->getTelefonoPt()}','{$obj->getCelular()}','{$obj->getServicioMedico()}','{$obj->getServicioMedico()}','{$obj->getNumero()}','Usuario','{$obj->getEmail()}','{$obj->getTipo()}','{$obj->getReferencia()}','{$obj->getOtro()}','{$obj->getAcude()}','{$obj->getParentesco()}','{$obj->getAdulo()}','{$obj->getDrogasAlcohol()}','{$obj->getConsecunciaConsumo()}','{$obj->getMental()}','{$obj->getCriteriosAdmision()}','{$obj->getFecha()}','{$obj->getNombreFam()}','{$obj->getDomicilioFam()}','{$obj->getNumeroFam()}','{$obj->getColoniaFam()}','{$obj->getTelefonoParticularFam()}','{$obj->getCelularFam()}')";
        var_dump($sql);
        $statement = $this->tableGateway->getAdapter()->createStatement($sql);
        $statement->execute();
                
    }
    
    public function hojaIngreso($idpaciente){
         $sql = "CALL sp_hoja_ingreso({$idpaciente})";
         $result = $this->tableGateway->getAdapter()->createStatement($sql);
         $result->execute();
         $statement = $result->getResource();
         $resultSet1 = $statement->fetchAll(\PDO::FETCH_ASSOC);
         return $resultSet1;
    }
    
    public function editarIngreso(Ingreso $obj){
      
    }
    
   public function buscarRFC($RFC){
        $rowSet = $this->tableGateway->select(['rfc' => (string) $RFC]);
        $row = $rowSet->current();
//        if (!$row)
//            throw new RuntimeException("No se puede tener acceso a : $RFC");
        return $row;
    }

    public function obtnerID($id) {
        
    }

    public function guardar(Ingreso $obj) {
        
    }

    public function eliminar(Ingreso $obj) {
        
    }

}
