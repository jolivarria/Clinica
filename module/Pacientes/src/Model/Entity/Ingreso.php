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

    //PROPIEDADES DE LA TABLA INGRESOS//
    private $idingreso; //int(11) AI PK 
    private $idpacienteIngreso; // int(11) PK 
    private $tipo; // enum('Voluntario','Involuntario','Obligatorio') 
    private $referencia; // enum('Domicilio Particular','Institución Pública','Institución Privada','Hospital Psiquiatrico','Centro de Redaptación Social') 
    private $otro; // varchar(45) 
    private $acude; // enum('Solo','Amigo','Vecino','Familiar','Parentesco') 
    private $parentesco; // varchar(45) 
    private $adulo; // enum('Si','No') 
    private $drogasAlcohol; // enum('Si','No') 
    private $consecunciaConsumo; // enum('Si','No') 
    private $mental; // enum('Si','No') 
    private $criteriosAdmision; // enum('Si','No') 
    private $fechaIngreso; // datetime
    //paciente
    private $idpaciente; //int(11) AI PK 
    private $nacionalidad_idnacionalidad; // int(11) PK 
    private $municipios_idestados; // int(11) PK 
    private $municipios_idmunicipios; // int(11) PK 
    private $solicitudIngreso_idSolicitud; // int(11) 
    private $rfc; // varchar(45) 
    private $foto; // varchar(45) 
    private $nombre; // varchar(45) 
    private $sexo; // enum('Hombre','Mujer') 
    private $fechaNac; // date 
    private $edad; // varchar(45) 
    private $direccion; // varchar(45) 
    private $escolaridad; // varchar(45) 
    private $ocupacion; // varchar(45) 
    private $estadoCivil; // varchar(45) 
    private $codigoPostal; // varchar(45) 
    private $telefonoParticular; // varchar(45) 
    private $celular; // varchar(45) 
    private $telefonoTrabajo; // varchar(45) 
    private $servicioMedico; // enum('Si','No') 
    private $tipoServicio; // varchar(45) 
    private $numero; // varchar(45) 
    private $tipoPaciente; // enum('Servidor','Anexado') 
    private $email; // varchar(45)
    //familiaress
    private $idfamiliares; //  int(11) AI PK 
    private $paciente_idpaciente; //  int(11) PK 
    private $nombreFam; //  varchar(45) 
    private $domicilioFam; //  varchar(45) 
    private $numeroFam; //  varchar(45) 
    private $coloniaFam; // varchar(45) 
    private $municipioFam; //  varchar(45) 
    private $telefonoParticularFam; //  varchar(45) 
    private $celularFam; //  varchar(45) 
    private $telefonoTrabajoFam; //  varchar(45) 
    private $legal; //  enum('Si','No')

    
    
    
    public function exchangeArray($data) {
        $this->idingreso = (isset($data['idingreso'])) ? $data['idingreso'] : null;
        $this->idpaciente = (isset($data['idpaciente'])) ? $data['idpaciente'] : null;
        $this->tipo = (isset($data['tipo'])) ? $data['tipo'] : null;
        $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
