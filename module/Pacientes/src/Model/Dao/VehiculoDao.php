<?php

namespace Pacientes\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Pacientes\Model\Entity\Vehiculo;
use RuntimeException;

class VehiculoDao implements IVehiculosDao {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtnerID($id) {
        $rowSet = $this->tableGateway->select(['idvehiculos' => (int) $id]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $id");
        return $row;
    }

    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function guardar(Vehiculo $obj) {
        $data = [
            'idvehiculos' => $obj->getIdvehiculos(),
            'marca' => $obj->getMarca(),
            'modelo' => $obj->getModelo(),
            'placas' => $obj->getModelo(),
            'descripcion' => $obj->getDescripcion(),
        ];

        $id = (int) $obj->getIdvehiculos();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtnerID($id)) {
                $this->tableGateway->update($data, ['idvehiculos' => $id]);
            } else {
                throw new RuntimeException("No se puede guardar: $id");
            }
        }
    }

    public function eliminar(Vehiculo $obj) {
        $this->tableGateway->delete(['idvehiculos' => $obj->getIdvehiculos()]);
    }

}
