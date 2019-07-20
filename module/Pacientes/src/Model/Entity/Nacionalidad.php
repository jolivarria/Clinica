<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pacientes\Model\Entity;

/**
 * Description of Empleado
 *
 * @author jorge
 */
class Nacionalidad {

    private $idnacionalidad; //int(11) AI PK 
    private $nacionalidad; //varchar(45) 
    private $nomenclatura; //varchar(45)

    public function exchangeArray($data) {
        $this->idnacionalidad = (isset($data['idnacionalidad'])) ? $data['idnacionalidad'] : null;
        $this->nacionalidad = (isset($data['nacionalidad'])) ? $data['nacionalidad'] : null;
        $this->nomenclatura = (isset($data['nomenclatura'])) ? $data['nomenclatura'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    

}
