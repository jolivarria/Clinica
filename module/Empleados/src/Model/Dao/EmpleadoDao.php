<?php

namespace Empleados\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Empleados\Model\Entity\Empleado;
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
class EmpleadoDao implements IEmpleadoDao {

//put your code here
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtnerEmpleadoID($id) {
        $rowSet = $this->tableGateway->select(['idEmpleados' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a Empleado: $id");
        return $row;
    }

    public function obtenerEmpleado() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function guardar(Empleado $emplado) {
        $data = [
            'idEmpleados' => $emplado->getIdEmpleados(),
            'foto' => $emplado->getFoto(),
            'numeroEmpleado' => $emplado->getNumeroEmpleado(),
            'nombreCompleto' => $emplado->getNombreCompleto(),
            'fechaNac' => $emplado->getFechaNac(),
            'correo' => $emplado->getCorreo(),
            'telefono' => $emplado->getTelefono(),
            'celular' => $emplado->getCelular(),
            'domicilio' => $emplado->getDomicilio(),
            'sexo' => $emplado->getSexo(),
            'tipoPlaza' => $emplado->getTipoPlaza(),
            'nombramiento' => $emplado->getNombramiento(),
            'estado' => $emplado->getEstado(),
        ];

        $id = (int) $emplado->getIdEmpleados();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if($this->obtnerEmpleadoID($id)){
                $this->tableGateway->update($data,['idEmpleados' => $id]);
            }else{
                throw new RuntimeException("No se puede guardar el Empleado: $id");
            }
                
        }
    }

    public function eliminar(Empleado $emplado) {
        $this->tableGateway->delete(['idEmpleados' => $emplado->getIdEmpleados()]);
    }

}
