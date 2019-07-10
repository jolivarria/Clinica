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
class Ingreso {

    private $idingreso; //int(11) AI PK 
    private $idpaciente; // int(11) PK 
    private $tipo; // enum('Voluntario','Involuntario','Obligatorio') 
    private $referencia; // enum('Domicilio Particular','Institución Pública','Institución Privada','Hospital Psiquiatrico','Centro de Redaptación Social') 
    private $otro; // varchar(45) 
    private $adulo; // enum('Si','No') 
    private $drogasAlcohol; // enum('Si','No') 
    private $consecunciaConsumo; // enum('Si','No') 
    private $mental; // enum('Si','No') 
    private $criteriosAdmision; // enum('Si','No') 
    private $fechaIngreso; // datetime 
    private $expediente; // tinyint(4)
    
    

    public function exchangeArray($data) {
        $this->idDepartamento = (isset($data['idDepartamento'])) ? $data['idDepartamento'] : null;
        $this->idConfiguracion = (isset($data['idConfiguracion'])) ? $data['idConfiguracion'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
