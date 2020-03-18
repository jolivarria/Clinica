<?php

namespace Inventario\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Inventario\Model\Entity\Producto;
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
class ProductoDao implements IProductoDao {

//put your code here
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function obtnerID($id) {
        
    }

    public function buscarProductoNombre($nombre) {
        $resultSet = $this->tableGateway->select(['nombre' => $nombre]);
        return $resultSet;
    }

    public function buscarProductoCodigo($idproductos) {
        $rowSet = $this->tableGateway->select(['idproductos' => (int) $idproductos]);
        $row = $rowSet->current();
        if (!$row)
            throw new RuntimeException("No se puede tener acceso a : $idproductos");
        return $row;
    }

    public function guardar(Producto $obj) {
        $data = [
            'idproductos' => $obj->getIdproductos(),
            'codigo' => $obj->getCodigo(),
            'nombre' => $obj->getNombre(),
            'unidadMedida' => $obj->getUnidadMedida(),
            'precio' => $obj->getPrecio(),
            'descripcion' => $obj->getDescripcion(),
        ];

        $id = (int) $obj->getIdproductos();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtnerID($id)) {
                $this->tableGateway->update($data, ['idproductos' => $id]);
            } else {
                throw new RuntimeException("No se puede guardar: $id");
            }
        }
    }

    public function eliminar(Producto $obj) {
        
    }

    public function ejectuarStoreProcedure() {
        
    }

}
